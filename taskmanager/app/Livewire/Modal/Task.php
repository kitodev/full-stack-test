<?php

namespace App\Livewire\Modal;

use Livewire\Component;

class Task extends Component
{
    public function mount(int $id)
    {
    }

    public function render()
    {
        return view('livewire.modal.task');
    }
}
