<?php

namespace App\Livewire\Modal;

use App\Models\Task as TaskModel;
use App\Livewire\Forms\TaskForm;
use App\Models\Assignee;
use Livewire\Component;

class UpdateTask extends Component
{
    public TaskForm $form;
    public $task;

    public function mount($id)
    {
        $this->task = TaskModel::findOrFail($id);
        $this->form->setAssignees(Assignee::all());
        $this->form->fillForm($this->task);
    }

    public function delete()
    {
        TaskModel::destroy($this->task->id);
        // todo error alert

        $this->dispatch('taskUpdated');

        $this->dispatch('hideModal');
    }

    public function save()
    {
        $this->form->update();

        $this->dispatch('taskUpdated');

        $this->dispatch('hideModal');
    }

    public function render()
    {
        return view('livewire.modal.create-task');
    }
}
