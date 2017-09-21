<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name', 'username', 'email', 'role_id', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules = [
        'name'                  =>  'required|min:3|max:255',
        'username'              =>  'required|min:3|max:255|unique:users',
        'email'                 =>  'required|email|min:3|max:255',
        'role_id'               =>  'required',
        'password'              =>  'required|min:3'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function role()
    {

        return $this->belongsTo(Role::class);

    }
}
