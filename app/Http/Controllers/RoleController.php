<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $data = [];
        $data['roles'] = Role::paginate();
        return view('roles.list',$data);
    }
    public function create() {
        return view('roles.new');
    }

    public function store(Request $request){ 
        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        return redirect()->route('roles.index')->with('message','işleminiz başarılı bir şekilde yapılmıştır.');
    }

    public function edit(Role $role) {
        $data = [];
        $data['role'] = $role;
        return view('roles.edit',$data);
    }

    public function update(Request $request, Role $role){
        $role->name = $request->input('name');
        $role->save();

        return redirect()->route('roles.index')->with('message','işleminiz başarılı bir şekilde yapılmıştır.');
    }
}
