<x-modals.base-modal>
  <form wire:submit="store" class="flex flex-col justify-center items-center gap-5">
    <h2 class="text-2xl text-accent font-bold">Add Worker</h2>

    <div class="w-full flex flex-col gap-5">
      <x-forms.input wire:model="first_name" id="first_name" label="First Name"/>
      <x-forms.input wire:model="last_name" id="last_name" label="Last Name"/>
      <x-forms.input wire:model="email" id="email" label="Email"/>
    </div>

    <div class="modal-action m-0 w-full">
      <div class="flex justify-center gap-5 w-full">
        <x-forms.button text="Cancel" wire:click="hide" class="w-full" :is-secondary="true"/>
        <x-forms.button text="Submit" wire:target="store" type="submit" class="w-full"/>
      </div>
    </div>
  </form>
</x-modals.base-modal>
