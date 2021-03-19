<?php
namespace App\Libraries;

use App\Models\Permission;

class PagePermissions
{
    
    public function register($slug, $class, $action, $name){
    	$control = Permission::select('id')
                        ->where('slug', $slug)
                        ->where('class', $class)
                        ->exists();

        if(!$control){
            $newPermission = new Permission();
            $newPermission->action = $action;
            $newPermission->name = $name;
            $newPermission->slug = $slug;
            $newPermission->class = $class;
            $newPermission->save();
        }
    	
    	
    }
}