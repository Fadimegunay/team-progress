<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users[] = [
            'name' => "Fadime Günay",
            'email' => "fadime.gunay@yandex.com",
            'password' => md5("345"),
            'is_super_admin' =>true,
            'is_active' =>true
        ];
        
        foreach($users as $user){
            $query = User::where('email', $user['email'])->exists();
            if(!$query){
                User::insert($users);
            }
        }
    }
}
