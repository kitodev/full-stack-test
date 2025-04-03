<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssignees extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'assignee_id'
    ];

    public function task()
    {
        return $this->belongsToMany(Task::class);
    }
}
