<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;


class TaskEdit extends Component
{
    public $task;
    public $name, $length, $is_completed, $priority, $due_date;
    public $selectedAssignees = [];



    #[On('edit-task')]
    public function loadTask(Task $task)
    {
        $this->task = $task;

        // Feladat mezőinek betöltése
        $this->name = $task->name;
        $this->length = $task->length;
        $this->is_completed = $task->is_completed;
        $this->priority = $task->priority;
        $this->due_date = $task->due_date->format('Y-m-d');
        $this->selectedAssignees = $task->assignees->pluck('id')->toArray();
    }

    public function saveTask()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'length' => 'integer|min:0',
            'priority' => 'in:low,normal,high',
            'due_date' => 'required|date|after_or_equal:today|not_in:'.json_encode($this->weekends()),
            'selectedAssignees' => 'array|max:4'
        ]);

        $this->task->update([
            'name' => $this->name,
            'length' => $this->length,
            'is_completed' => $this->is_completed,
            'priority' => $this->priority,
            'due_date' => $this->due_date,
        ]);

        $this->task->assignees()->sync($this->selectedAssignees); // Az assigneek frissítése

        $this->dispatch('taskUpdated'); // Frissítjük a task manager-t

        $this->reset(['name', 'length', 'is_completed', 'priority', 'due_date', 'selectedAssignees']);
    }

    private function weekends()
    {
        return [
            Carbon::now()->nextWeekendDay()->format('Y-m-d'),
            Carbon::now()->nextWeekendDay()->addDay()->format('Y-m-d'),
        ];
    }

    public function render()
    {
        return view('livewire.task-edit');
    }
}
