<?php
namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Task;
use App\Models\Assignee;
use Carbon\Carbon;

class TaskManager extends Component
{
    public function render()
    {
        return view('livewire.task-manager');
    }
}
