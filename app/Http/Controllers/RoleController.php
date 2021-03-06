<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index(){
        if (Gate::denies('access', 'role-list')) {
            return redirect()->route('home');
        }
        $data = [];
        $data['roles'] = Role::paginate();
        return view('roles.list',$data);
    }
    public function create() {
        if (Gate::denies('access', 'role-new')) {
            return redirect()->route('home');
        }
        return view('roles.new');
    }

    public function store(Request $request){ 
        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        return redirect()->route('roles.index')->with('message','işleminiz başarılı bir şekilde yapılmıştır.');
    }

    public function edit(Role $role) {
        if (Gate::denies('access', 'role-edit')) {
            return redirect()->route('home');
        }
        $data = [];
        $data['role'] = $role;
        return view('roles.edit',$data);
    }

    public function update(Request $request, Role $role){
        $role->name = $request->input('name');
        $role->save();

        return redirect()->route('roles.index')->with('message','işleminiz başarılı bir şekilde yapılmıştır.');
    }

    public function delete(Role $role){
        if (Gate::denies('access', 'role-delete')) {
            return redirect()->route('home');
        }
        $result = false;
        try {
            DB::beginTransaction();
            $role->delete();
            DB::commit();
            $result = true;
        } catch (Exception $exception) {
            DB::rollBack();
            $result = false;
        }
        return response()->json($result)->header('Content-Type', 'application/json');
    }
}
