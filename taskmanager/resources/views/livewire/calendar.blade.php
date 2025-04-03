<div class="container mt-4 weekly-calendar">
    <div class="d-flex justify-content-between mb-3">
        <button class="btn btn-primary" wire:click="previousWeek">&laquo; Előző hét</button>
        <h4>{{ $weekDays->first()->format('Y. F d.') }} - {{ $weekDays->last()->format('d.') }}</h4>
        <button class="btn btn-primary" wire:click="nextWeek">Következő hét &raquo;</button>
    </div>
    <div class="row">
        @foreach($weekDays as $day)
            @php
                $dayFormatted = $day->format('Y-m-d');
            @endphp
            <livewire:day
                :date="$dayFormatted"
                :assignees="$assigneeHours[$dayFormatted] ?? []"
                :events="$events[$dayFormatted] ?? []"
                :key="$dayFormatted"
            />
        @endforeach
    </div>
</div>
