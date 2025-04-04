<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignee extends Model
{
    use HasFactory;

    private $minutes = 0;

    protected $fillable = [
        'name'
    ];

    public function getBookedMinutesByDay(string $day): int
    {
        if (!isset($this->tasks)) {
            return 0;
        }

        /** @var Task $task */
        foreach ($this->tasks as $task) {
            if ($task->due_date->format('Y-m-d') === $day) {
                $this->minutes += $task->length;
            }
        }


        return $this->minutes;
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_assignees', 'assignee_id', 'task_id');
    }
}
