<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Settings\TeamController;
use App\Http\Controllers\Settings\HomeController;

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
    }
}
