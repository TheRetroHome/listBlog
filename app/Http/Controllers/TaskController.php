<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Services\ImageService;
class TaskController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    public function index()
    {
        $tags = Tag::where('user_id', Auth::id())->get();
        $tasks = Task::userTasks()->incomplete()->latest()->paginate(5);
        $pagination = $tasks->links('pagination::bootstrap-4');
        return view('main', compact('tags','tasks','pagination'));
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
            $data['image'] = $this->imageService->handleUpload($request->file('image'));
        }
        $data['user_id'] = Auth::id();
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
            $data['image'] = $this->imageService->handleUpload($request->file('image'), $task->image);
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
    public function markAsCompleted(Task $task)
    {
        $task->update(['is_completed' => 1]);
        return redirect()->route('main')->with('success', 'Task marked as completed.');
    }
    public function completed()
    {
        $tags = Tag::where('user_id', Auth::id())->get();
        $tasks = Task::userTasks()->completed()->latest()->paginate(5);
        $pagination = $tasks->links('pagination::bootstrap-4');
        return view('completed', compact('tags','tasks','pagination'));
    }
    public function filterByTag($tag)
    {
        $tag = Tag::where('name', $tag)->first();
        if ($tag) {
            $tasks = $tag->tasks()->userTasks()->incomplete()->latest()->paginate(5);
            $pagination = $tasks->links('pagination::bootstrap-4');
            return view('main', compact('tasks','pagination'));
        } else {
            return redirect()->route('main');
        }
    }

}
