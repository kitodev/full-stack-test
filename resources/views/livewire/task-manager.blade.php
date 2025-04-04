<div class="p-6 text-center">
    <button wire:click="$dispatch('showModal', {data: {'alias' : 'modal.createTask'}})"
         class="btn btn-primary"
    >
        Új feladat
    </button>

    <livewire:calendar />

</div>

