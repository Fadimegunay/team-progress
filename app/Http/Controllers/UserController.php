<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Team;
use App\Models\Role;
use App\Models\UserRole;

class UserController extends Controller
{
    public function index(){
        if (Gate::denies('access', 'users-list')) {
            return redirect()->route('home');
        }
        $data = [];
        if((bool) Auth::user()->is_super_admin)
            $data['users'] = User::where('is_active', true)->paginate();
        else
            $data['users'] = User::where('team_id',  Auth::user()->team_id)
                                    ->where('is_active', true)
                                    ->paginate();
        return view('users.list',$data);
    }

    public function create() {
        if (Gate::denies('access', 'users-new')) {
            return redirect()->route('home');
        }
        $datas = [];
        $datas['teams'] = Team::all();
        $datas['roles'] = Role::all();
        return view('users.new', $datas);
    }

    public function store(Request $request){ // aynı grup ismini kaydettirme
        $user = new User();
        $user->team_id =  $request->input('team');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = md5($request->input('password'));
        $user->is_super_admin = false;
        $user->is_active = true;
        if($user->save() && $request->exists('roles')){
            foreach($request->input('roles') as $role){
                $userRole = new UserRole();
                $userRole->user_id = $user->id;
                $userRole->role_id = $role;
                $userRole->save();
            }
        }

        return redirect()->route('users.index')->with('message','işleminiz başarılı bir şekilde yapılmıştır.');
    }

    public function edit(User $user) {
        if (Gate::denies('access', 'users-edit')) {
            return redirect()->route('home');
        }
        $datas = [];
        $datas['user'] = $user;
        $datas['teams'] = Team::all();
        $datas['roles'] = Role::all();
        return view('users.edit',$datas);
    }

    public function update(Request $request, User $user){
        $user->team_id = $request->input('team');
        $user->name = $request->input('name');
        if( $request->input('password'))
            $user->password = md5($request->input('password'));
        $user->save();

        if($request->exists('roles')){
            $user->roles()->delete();
            foreach($request->input('roles') as $role){
                $userRole = new UserRole();
                $userRole->user_id = $user->id;
                $userRole->role_id = $role;
                $userRole->save();
            }
        }

        return redirect()->route('users.index')->with('message','işleminiz başarılı bir şekilde yapılmıştır.');
    }

    public function delete(User $user) {
        if (Gate::denies('access', 'users-delete')) {
            return redirect()->route('home');
        }
        $result = false;
        try {
            DB::beginTransaction();
            $user->is_active = false;
            $user->save();
            DB::commit();
            $result = true;
        } catch (Exception $exception) {
            DB::rollBack();
            $result = false;
        }
        return response()->json($result)->header('Content-Type', 'application/json');        
    }
}
