<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;

class UserController extends Controller
{
    public function index(){
        $data = [];
        $data['users'] = User::where('is_super_admin',false)->paginate();
        return view('users.list',$data);
    }

    public function create() {
        $data = [];
        $data['teams'] = Team::all();
        return view('users.new', $data);
    }

    public function store(Request $request){ // aynı grup ismini kaydettirme
        $user = new User();
        $user->team_id =  $request->input('team');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = md5($request->input('password'));
        $user->is_super_admin = false;
        $user->is_active = true;
        $user->save();

        return redirect()->route('users.index')->with('message','işleminiz başarılı bir şekilde yapılmıştır.');
    }

    public function edit(User $user) {
        $datas = [];
        $datas['user'] = $user;
        $datas['teams'] = Team::all();
        return view('users.edit',$datas);
    }

    public function update(Request $request, User $user){
        $user->team_id = $request->input('team');
        $user->name = $request->input('name');
        if( $request->input('password'))
            $user->password = md5($request->input('password'));
        $user->save();

        return redirect()->route('users.index')->with('message','işleminiz başarılı bir şekilde yapılmıştır.');
    }
}
