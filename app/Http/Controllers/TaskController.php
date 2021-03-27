<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskUser;
use App\Models\Team;
use App\Models\User;

class TaskController extends Controller
{
    
    public function index(Request $request)
	{
        if (Gate::denies('access', 'task-list')) {
            return redirect()->route('home');
        }
		$data = [];
		if (Auth::user()->is_super_admin == 1) {
			$tasks = Task::orderByDesc('id')->paginate();
        } else {
			$team_id = Auth::user()->team_id;
			$user_id = Auth::user()->id;
			$tasks = Task::where('user_id', $user_id)
				->orWhereHas('task_users', function ($query) use ($user_id) {
					$query->where('task_users.user_id', $user_id);
				})
                ->orWhere(function ($query_) use ($team_id) {
					$query_->whereDoesntHave('task_users')
						->where('team_id', $team_id);
				})
                ->orderByDesc('id')->paginate();
        }
        $data['tasks'] = $tasks;
        return view('tasks.list', $data);
    }

    public function create() {
        if (Gate::denies('access', 'task-new')) {
            return redirect()->route('home');
        }
        $datas = [];
        $datas['teams'] = Team::all();
        $datas['taskStatus'] = TaskStatus::all();
        return view('tasks.new', $datas);
    }

    public function store(Request $request) {
        $newTask = new Task();
        $newTask->team_id = (int) $request->input('team');
        $newTask->task_status_id = (int) $request->input('task_status');
        $newTask->user_id = (int) Auth::user()->id;
        $newTask->header = $request->input('header');
        $newTask->description = $request->input('description');
        $newTask->end_date =  $request->input('end_date');
        $control = false;
        if ($request->file) {
            if(!File::isDirectory('storage/uploads/tasks')){
                File::makeDirectory('storage/uploads/tasks', 0777, true, true);
            }
            $file = $request->file('file');
            $file_ = $this->fileExtension($file->getClientOriginalName());
            if($file_){
                $newTask->file = $this->generateName($file->getClientOriginalName());
                $control = true;
            }

        }
        $newTask->save();
        if ($control) {
            $file->storeAs('uploads/tasks', $newTask->file);
        }
        if($request->exists('users')){
            foreach($request->input('users') as $user){
                $newUser = new TaskUser();
                $newUser->task_id = $newTask->id;
                $newUser->user_id = $user;
                $newUser->save();
            }
        }
        return redirect()->route('tasks.index')->with('message','işleminiz başarılı bir şekilde yapılmıştır.');
    }

    public function edit(Task $task) {
        if (Gate::denies('access', 'task-edit')) {
            return redirect()->route('home');
        }
        $data = [];
        $data['task'] = $task;
        $data['teams'] = Team::all();
        $data['taskStatus'] = TaskStatus::all();
        $data['users'] = User::where([
                                        'team_id' => $task->team_id,
                                        'is_active' => true
                                    ])->get();
        return view('tasks.edit',$data);
    }

    public function update(Request $request, Task $task) {
        $task->task_status_id = (int) $request->input('task_status');
        $task->header = $request->input('header');
        $task->description = $request->input('description');
        $task->end_date =  $request->input('end_date');
        $control = false;
        if ($request->file) {
            if(!File::isDirectory('storage/uploads/tasks')){
                File::makeDirectory('storage/uploads/tasks', 0777, true, true);
            }
            $file = $request->file('file');
            $file_ = $this->fileExtension($file->getClientOriginalName());
            if($file_){
                $task->file = $this->generateName($file->getClientOriginalName());
                $control = true;
            }

        }
        $task->save();
        if ($control) {
            $file->storeAs('uploads/tasks', $task->file);
        }
        if($request->exists('users')){
            $task->task_users()->delete();
            foreach($request->input('users') as $user){
                $newUser = new TaskUser();
                $newUser->task_id = $task->id;
                $newUser->user_id = $user;
                $newUser->save();
            }
        }
        return redirect()->route('tasks.index')->with('message','işleminiz başarılı bir şekilde yapılmıştır.');
    }

    public function delete(Task $task){
        if (Gate::denies('access', 'task-delete')) {
            return redirect()->route('home');
        }
        $result = false;
        try {
            DB::beginTransaction();
            $task->delete();
            DB::commit();
            $result = true;
        } catch (Exception $exception) {
            DB::rollBack();
            $result = false;
        }
        return response()->json($result)->header('Content-Type', 'application/json');
    }

    public function fileExtension($file){
        $extension = pathinfo($file,PATHINFO_EXTENSION);
        if($extension == "jpeg" || $extension == "jpg" || $extension == "png" || $extension == "pdf" )
            return true;
        else
            return false;
    }
    
    public function generateName($file){
        $extension = pathinfo($file,PATHINFO_EXTENSION);
        return md5(microtime(true)).".".$extension;
    }

}
