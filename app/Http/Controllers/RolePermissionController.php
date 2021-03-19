<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;

class RolePermissionController extends Controller
{
    public function index($role_id)
    {
        $datas = [];
        $role = Role::where('id',$role_id)->first();
        $permissions = $role->permissions()->paginate();
        $datas['permissions'] = $permissions;
        $datas['role'] = $role;
        return view('role-permissions.list', $datas);
    }

    public function new($role_id)
    {
        $datas = [];
        $role_value = Role::select('id','name')
                      ->where('id', $role_id)->first();
	    $datas['role'] = $role_value;
	    $datas['permissions'] = Permission::whereNotIn('id', $role_value->permissions()->pluck('permission_id'))->get();
        return view('role-permissions.new', $datas);

    }

    public function store(Request $request)
    {
	    $role_id = $request->input('role_id');
	    $permissions = $request->input('permissions');
	    foreach ($permissions as $item) {
		    $newRolePermission = new RolePermission();
		    $newRolePermission->role_id = $role_id;
		    $newRolePermission->permission_id = $item;
		    $newRolePermission->save();
		    $newRolePermission->refresh();
		
	    }
	    return redirect()->route('role-permissions.index', ['id' => $role_id]);
    }
}
