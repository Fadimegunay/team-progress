<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public function users(){
    	return $this->belongsToMany(User::class,'task_users','task_id','user_id','id','id')->withPivot('id');
    }

    public function task_users() {
	    return $this->hasMany(TaskUser::class, 'task_id', 'id');
    }

    public function status() {
	    return $this->hasOne(TaskStatus::class, 'id', 'task_status_id');
    }

    public function user() {
	    return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function team() {
	    return $this->hasOne(Team::class, 'id', 'team_id');
    }

}
