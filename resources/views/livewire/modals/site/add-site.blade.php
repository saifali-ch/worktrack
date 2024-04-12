<x-modals.base-modal>
  <form wire:submit="store" class="flex flex-col justify-center items-center gap-5">
    <h2 class="text-2xl text-accent font-bold">Add Site</h2>

    <div class="w-full">
      <x-forms.input wire:model="name" id="name" label="Site Name"/>
    </div>

    <div class="modal-action m-0 w-full">
      <div class="flex justify-center gap-5 w-full">
        <x-forms.button text="Cancel" wire:click="hide" class="w-full" :is-secondary="true"/>
        <x-forms.button text="Submit" wire:target="store" type="submit" class="w-full"/>
      </div>
    </div>
  </form>
</x-modals.base-modal>
