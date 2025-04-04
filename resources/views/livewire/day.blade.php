<div class="col border text-center py-3 position-relative day">
    <div>
        <strong>{{ $date->format('l') }}</strong><br>
        {{ $date->format('Y-m-d') }}
    </div>
    @foreach($events as $event)

        <div wire:click="$dispatch('showModal', {data: {'alias' : 'modal.updateTask', 'params': { id: {{ $event['id'] }} }}})"
             class="event"
             style="background-color: {{ $event['color'] }};"
        >
            <div class="event-title" style="padding: 5px;">
                {{ $event['title'] }}<br>
                {{ $event['length'] }}
            </div>
        </div>

    @endforeach

    <hr>
    <p>
        Beosztottak:
    </p>

    @foreach($assignees as $assignee)
        @php
            $width = ($assignee['totalHours'] / (8 * 60)) * 100;
            $color = \App\Components\Helpers\Color::getRandomColorWithOpacity();
        @endphp
            <div
                class="assignee-summary"
                style="background: linear-gradient(to right, {{ $color }} {{ $width }}%, transparent {{ $width }}%);"
            >
                {{ $assignee['name'] }} - {{ round($assignee['totalHours'] / 60, 2) }} óra
            </div>
        @endforeach
</div>

