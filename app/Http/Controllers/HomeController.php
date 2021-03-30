<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Task;

class HomeController extends Controller
{
    public function index(){
        $data = [];
        $team_id = Auth::user()->team_id;
        $user_id = Auth::user()->id;
        $data['tasks'] = Task::where('user_id', $user_id)
                        ->orWhereHas('task_users', function ($query) use ($user_id) {
                            $query->where('task_users.user_id', $user_id);
                        })
                        ->orWhere(function ($query_) use ($team_id) {
                            $query_->whereDoesntHave('task_users')
                                ->where('team_id', $team_id);
                        })
                        ->orderByDesc('id')->paginate();
        return view('home', $data);
    }
}
