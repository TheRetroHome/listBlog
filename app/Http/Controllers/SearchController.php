<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
class SearchController extends Controller
{
    public function search(Request $request){
        $request->validate([
            'search'=>'required',
        ]);
        $tasks = Task::where('name', 'like', '%'.$request->search.'%')
            ->where('user_id', Auth::id())
            ->where('is_completed', false)
            ->with('tags')
            ->paginate(5);
        $pagination = $tasks->links('pagination::bootstrap-4');
        return view('search', compact('tasks','pagination'));
    }

}
