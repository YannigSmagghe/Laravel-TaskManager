<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
    ];

    public static $rules = [
        'title'                    =>    'required|min:3|max:255',
        'description'            =>    'required|min:3|max:255',
        'status'                =>  'required'
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function subtasks()
    {
        return $this->hasMany(SubTask::class);
    }
}
