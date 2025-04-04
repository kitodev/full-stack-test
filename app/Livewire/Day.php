<?php

namespace App\Livewire;

use App\Components\Helpers\Color;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class Day extends Component
{
    public $date;
    #[Reactive]
    public $events = [];  // Események
    #[Reactive]
    public $assignees = [];

    public function mount($date, $events = [], $assignees = [])
    {
        $this->date = Carbon::parse($date);  // A nap dátuma
        $this->events = $events;  // A naphoz tartozó események
        $this->assignees = $assignees;
    }

    public function render()
    {
        return view('livewire.day');
    }
}
