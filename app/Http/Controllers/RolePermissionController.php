<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Role;
use App\Models\Permission;
use App\Models\RolePermission;

class RolePermissionController extends Controller
{
    public function index($role_id)
    {
        if (Gate::denies('access', 'role_permission-list')) {
            return redirect()->route('home');
        }
        $datas = [];
        $role = Role::where('id',$role_id)->first();
        $permissions = $role->permissions()->paginate();
        $datas['permissions'] = $permissions;
        $datas['role'] = $role;
        return view('role-permissions.list', $datas);
    }

    public function new($role_id)
    {
        if (Gate::denies('access', 'role_permission-new')) {
            return redirect()->route('home');
        }
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

    public function delete(RolePermission $role_permission)
    {
        if (Gate::denies('access', 'role_permission-delete')) {
            return redirect()->route('home');
        }
        $role = RolePermission::select('role_id')->where('id',$role_permission->id)->first();
        $role_permission->delete();
        
        return redirect()->route('role-permissions.index', ['id' => $role->role_id])->with('message','i??leminiz ba??ar??l?? bir ??ekilde yap??lm????t??r.');

    }
}
