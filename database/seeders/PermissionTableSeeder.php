<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\TaskController;

use App\Libraries\PagePermissions;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pagePermissions = new PagePermissions();

		$pagePermissions->register('users-list', UserController::class, 'list', 'Kullanıcı Listeleme');
		$pagePermissions->register('users-new', UserController::class, 'new', 'Kullanıcı Ekleme');
		$pagePermissions->register('users-edit', UserController::class, 'edit', 'Kullanıcı Güncelleme');
		$pagePermissions->register('users-delete', UserController::class, 'delete', 'Kullanıcı Silme');

        $pagePermissions->register('role-list', RoleController::class, 'list', 'Rol Listeleme');
		$pagePermissions->register('role-new', RoleController::class, 'new', 'Rol Ekleme');
		$pagePermissions->register('role-edit', RoleController::class, 'edit', 'Rol Güncelleme');
		$pagePermissions->register('role-delete', RoleController::class, 'delete', 'Rol Silme');

        $pagePermissions->register('team-list', TeamController::class, 'list', 'Takım Listeleme');
		$pagePermissions->register('team-new', TeamController::class, 'new', 'Takım Ekleme');
		$pagePermissions->register('team-edit', TeamController::class, 'edit', 'Takım Güncelleme');
		$pagePermissions->register('team-delete', TeamController::class, 'delete', 'Takım Silme');

        $pagePermissions->register('role_permission-list', RolePermissionController::class, 'list', 'Rol İzin Listeleme');
		$pagePermissions->register('role_permission-new', RolePermissionController::class, 'new', 'Rol İzin Ekleme');

        $pagePermissions->register('task-list', TaskController::class, 'list', 'Görev Listeleme');
		$pagePermissions->register('task-new', TaskController::class, 'new', 'Görev Ekleme');
		$pagePermissions->register('task-edit', TaskController::class, 'edit', 'Görev Güncelleme');
		$pagePermissions->register('task-delete', TaskController::class, 'delete', 'Görev Silme');
    }
}
