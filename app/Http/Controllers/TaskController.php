<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::where('user_id', Auth::id())->get();
        $tasks = Task::where('user_id', Auth::id())->latest()->get();
        return view('main', compact('tags','tasks'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Auth::user()->tags;
        return view('create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Создаем директорию с датой, если она еще не существует
            $date = date('Y-m-d');
            if (!File::exists(public_path("images/{$date}"))) {
                File::makeDirectory(public_path("images/{$date}"), 0777, true);
            }

            // Загружаем изображение в новую директорию и изменяем его размер
            $imageName = time().'.'.$request->image->extension();
            $imagePath = public_path("images/{$date}/{$imageName}");
            $request->image->move(public_path("images/{$date}"), $imageName);
            $img = Image::make($imagePath)->resize(150, 150);
            $data['image'] = "images/{$date}/{$imageName}";
            $img->save($imagePath);
        }

        $data['user_id'] = Auth::id();

        // Создаем задачу и присоединяем к ней теги
        $task = Task::create($data);
        if (isset($data['tags'])) {
            $tagIds = Tag::whereIn('name', $data['tags'])->where('user_id', Auth::id())->get()->pluck('id');
            $task->tags()->sync($tagIds);
        }

        return redirect()->route('main')->with('success', 'Task created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $tags = Tag::all();
        return view('edit', compact('task', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskStoreRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $date = date('Y-m-d', strtotime($task->created_at));
            if (File::exists(public_path("images/{$date}/{$task->image}"))) {
                File::delete(public_path("images/{$date}/{$task->image}"));
            }

            $date = date('Y-m-d');
            $imageName = time().'.'.$request->image->extension();
            $imagePath = public_path("images/{$date}/{$imageName }");

            $request->image->move(public_path("images/{$date}"), $imageName);
            $img = Image::make($imagePath)->resize(150, 150);
            $data['image'] = "images/{$date}/{$imageName}";
            $img->save($imagePath);
        }

        $task->update($data);

        if (isset($data['tags'])) {
            $task->tags()->sync($data['tags']);
        }
        return redirect()->route('main')->with('success', 'Task updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $date = date('Y-m-d', strtotime($task->created_at));

        if (File::exists(public_path("images/{$date}/{$task->image}"))) {
            File::delete(public_path("images/{$date}/{$task->image}"));
        }

        $task->delete();
        return redirect()->route('main')->with('success', 'Task deleted successfully.');
    }
}
