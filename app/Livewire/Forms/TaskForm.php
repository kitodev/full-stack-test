<?php

namespace App\Livewire\Forms;

use App\Models\Assignee;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Form;

class TaskForm extends Form
{
    public $name;
    public $length = 0;
    public $is_completed = false;
    public $priority = 'normal';
    public $due_date;
    public $selectedAssignees = [];

    public $assignees = [];
    public $task;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'length' => 'integer|min:0',
            'priority' => 'in:low,normal,high',
            'due_date' => [
                'required',
                'date',
                'after_or_equal:today',
                Rule::notIn($this->weekends()), // Assumes weekends() returns an array of dates
            ],
            'selectedAssignees' => [
                'array',
                'min:1',
                'max:4',
            ],
        ];
    }

    public function checkHours()
    {
        /** @var Assignee $assignee */
        foreach ($this->selectedAssignees as $selectedAssigneeId) {
            $assignee = Assignee::where('id', $selectedAssigneeId)->with('tasks')->first();
            if ($assignee->getBookedMinutesByDay($this->due_date) + $this->length >= env("WORKDAY_LENGTH")) {

            };
        }
    }

    public function setAssignees(Collection $assignees)
    {
        $this->assignees = $assignees;
    }

    public function store()
    {
        $this->validate();

        $task = Task::create([
            'name' => $this->name,
            'length' => $this->length,
            'is_completed' => $this->is_completed,
            'priority' => $this->priority,
            'due_date' => $this->due_date,
        ]);

        $task->assignees()->attach($this->selectedAssignees);
    }

    public function update()
    {
        $this->validate();

        $this->task->update([
            'name' => $this->name,
            'length' => $this->length,
            'is_completed' => $this->is_completed,
            'priority' => $this->priority,
            'due_date' => $this->due_date,
        ]);

        $this->task->assignees()->sync($this->selectedAssignees);
    }

    public function fillForm(Task $task)
    {
        $this->task = $task;
        $this->name = $task->name;
        $this->length = $task->length;
        $this->is_completed = $task->is_completed;
        $this->priority = $task->priority;
        $this->due_date = $task->due_date->format('Y-m-d');
        $this->selectedAssignees = $task->assignees->pluck('id')->toArray();
    }

    private function weekends()
    {
        $dueDate = Carbon::parse($this->due_date);
        if ($dueDate->isWeekend()) {
            return [
                $this->due_date
            ];
        }

        return [];
    }
}
