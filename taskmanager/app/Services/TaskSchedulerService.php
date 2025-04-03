<?php

namespace App\Services;


use App\Components\Helpers\Color;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskSchedulerService
{
    public function getTasksWithAssigneesBetween(string $startDate, string $endDate): Collection
    {
        return Task::where('due_date', '>=', $startDate)
            ->where('due_date', '<=', $endDate)
            ->with('assignees')
            ->get();
    }

    public function getWeeklyTasks(string $startDate, string $endDate): array
    {
        $tasks = $this->getTasksWithAssigneesBetween($startDate, $endDate);

        $events = [];
        $assigneeHours = [];

        $tasks->each(function (Task $task) use (&$events, &$assigneeHours) {
            $date = $task->due_date->format('Y-m-d');

            $events[$date][] = [
                'id' => $task->id,
                'length' => $task->length,
                'title' => $task->name,
                'color' => $task->is_completed ? 'green' : Color::getPriorityColors($task->priority)
            ];

            foreach ($task->assignees as $assignee) {
                $assigneeId = $assignee->id;

                if (!isset($assigneeHours[$date][$assigneeId])) {
                    $assigneeHours[$date][$assigneeId] = [
                        'name' => $assignee->name,
                        'totalHours' => 0,
                    ];
                }

                $assigneeHours[$date][$assigneeId]['totalHours'] += $task->length;
            }
        });

        return compact(
            'events',
            'assigneeHours'
        );
    }
}
