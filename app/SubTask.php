<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    protected $table = 'subtasks';

    protected $fillable = [
        'task_id',
        'title',
        'description',
        'status',
    ];

    public static $rules = [
        'task_id'                =>    'required',
        'title'                    =>    'required|min:3|max:255',
        'description'            =>    'required|min:3',
        'status'                =>    'required'
    ];

    public function task() 
    {
        return $this->belongsTo(Task::class);
    }
}
