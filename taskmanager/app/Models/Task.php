<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public string $color;

    protected $fillable = [
        'id',
        'name',
        'length',
        'is_completed',
        'assignees',
        'priority',
        'due_date',
    ];

    public function getAllTasks()
    {

    }

    protected $casts = [
        'is_completed' => 'boolean',
        'due_date' => 'date',
    ];

    public function assignees()
    {
        return $this->belongsToMany(Assignee::class, 'task_assignees', 'task_id', 'assignee_id');
    }
}
