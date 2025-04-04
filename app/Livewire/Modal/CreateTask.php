<?php

namespace App\Livewire\Modal;

use App\Models\Task as TaskModel;
use App\Livewire\Forms\TaskForm;
use App\Models\Assignee;
use Livewire\Component;

class CreateTask extends Component
{
    public TaskForm $form;

    public function mount()
    {
        $this->form->setAssignees(Assignee::all());
    }

    public function save()
    {
        $this->form->store();

        $this->dispatch('taskUpdated');

        $this->dispatch('hideModal');
    }

    public function render()
    {
        return view('livewire.modal.create-task');
    }
}
