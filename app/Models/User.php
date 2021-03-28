<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\UserRole;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_super_admin',
        'is_active'
    ];

    public function roles() {
        return $this->hasMany(UserRole::class,'user_id','id');
    }

    public function taskUser() {
        return $this->hasMany(TaskUser::class, 'user_id', 'id');
    }

    public function canAccess($slug){
        $user_id = $this->id;

        $can=  UserRole::where('user_id',$user_id)
                        ->whereHas('role.permissions', function($query) use ($slug){
                            $query->where('slug', $slug);
                        })
                        ->exists();
        if($can){
            return true;
        }else{
            return false;
        }
    }
}
