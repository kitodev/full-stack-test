<?php

namespace App\Livewire;

use App\Services\TaskSchedulerService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class Calendar extends Component
{
    public Collection $weekDays;
    public $currentWeek;
    public array $events = [];
    public array $assigneeHours = [];

    protected TaskSchedulerService $taskSchedulerService;

    public function mount()
    {
        $this->currentWeek = Carbon::now()->startOfWeek();
        $this->generateWeek();
        $this->loadEvents();
    }

    public function boot(TaskSchedulerService $taskSchedulerService)
    {
        $this->taskSchedulerService = $taskSchedulerService;
    }

    public function generateWeek()
    {
        $this->weekDays = collect(range(0, 6))
            ->map(fn($day) => $this->currentWeek->copy()->addDays($day));
    }

    public function previousWeek()
    {
        $this->currentWeek->subWeek();
        $this->generateWeek();
        $this->loadEvents();
    }

    public function nextWeek()
    {
        $this->currentWeek->addWeek();
        $this->generateWeek();
        $this->loadEvents();
    }

    #[On('taskUpdated')]
    public function loadEvents()
    {
        $data = $this->taskSchedulerService->getWeeklyTasks(
            $this->currentWeek->copy()->startOfWeek()->format('Y-m-d'),
            $this->currentWeek->copy()->endOfWeek()->format('Y-m-d')
        );

        $this->events = $data['events'];
        $this->assigneeHours = $data['assigneeHours'];
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
