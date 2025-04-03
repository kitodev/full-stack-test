<div id="task-modal">
    <div class="modal-header">
        <h4 class="modal-title">Feladat létrehozása</h4>
        <button type="button" class="btn-close" wire:click="$dispatch('hideModal')" aria-label="Close"></button>
    </div>
    <div class="modal-body">

        <div class="mb-3">
            <label for="taskName" class="form-label">Feladat neve</label>
            <input type="text" id="taskName" class="form-control" wire:model="form.name" placeholder="Feladat neve">
            @error('form.name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="taskLength" class="form-label">Időtartam (perc)</label>
            <input type="number" id="taskLength" min="0" class="form-control" wire:model="form.length" placeholder="Időtartam (perc)">
            @error('form.length') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Prioritás</label>
            <select id="priority" class="form-select" wire:model="form.priority">
                <option value="low">Alacsony</option>
                <option value="normal">Normál</option>
                <option value="high">Magas</option>
            </select>
        </div>

        <div class="mb-3">
            <input type="checkbox" id="taskIsCompleted" class="form-check-input" wire:model="form.is_completed">
            <label for="taskIsCompleted" class="form-label form-check-label">Befejezve</label>
        </div>

        <div class="mb-3">
            <label for="dueDate" class="form-label">Határidő</label>
            <input type="date" id="dueDate" class="form-control" wire:model="form.due_date">
            @error('form.due_date') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <h4 class="mt-3">Hozzárendeltek</h4>
        <div class="mb-3">
            <label for="selectAssignees" class="form-label">Válassz hozzárendelteket</label>
            <select id="selectAssignees" class="form-select" wire:model="form.selectedAssignees" multiple>
                @foreach($form->assignees as $assignee)
                    <option value="{{ $assignee->id }}">
                        {{ $assignee->name }}
                    </option>
                @endforeach
            </select>
            @error('form.selectedAssignees') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger {{ !empty($form->task) ? 'd-block' : 'd-none' }}" wire:click="delete">Törlés</button>
        <button type="button" class="btn btn-secondary" wire:click="$dispatch('hideModal')">Bezárás</button>
        <button type="button" class="btn btn-primary" wire:click="save">Mentés</button>
    </div>
</div>

