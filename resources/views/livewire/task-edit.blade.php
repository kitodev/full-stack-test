<div>
    @if($task)
        <h3>Szerkeszd a feladatot</h3>
        <form wire:submit.prevent="saveTask">
            <div>
                <label for="name">Név:</label>
                <input type="text" wire:model="name" id="name" required>
            </div>

            <div>
                <label for="length">Hossz (perc):</label>
                <input type="number" wire:model="length" id="length" min="0">
            </div>

            <div>
                <label for="priority">Prioritás:</label>
                <select wire:model="priority">
                    <option value="low">Alacsony</option>
                    <option value="normal">Normál</option>
                    <option value="high">Magas</option>
                </select>
            </div>

            <div>
                <label for="due_date">Ütemezett nap:</label>
                <input type="date" wire:model="due_date" id="due_date" required>
            </div>

            <div>
                <label for="assignees">Megbízottak:</label>
                <select wire:model="selectedAssignees" multiple>
                    @foreach($task->assignees as $assignee)
                        <option value="{{ $assignee->id }}">{{ $assignee->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Mentés</button>
        </form>
    @endif
</div>
