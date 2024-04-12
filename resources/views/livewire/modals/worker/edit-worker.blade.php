<x-modals.base-modal>
  <form wire:submit="update" class="flex flex-col justify-center items-center gap-5">
    <h2 class="text-2xl text-accent font-bold">Update Worker</h2>

    <div class="w-full flex flex-col gap-5">
      <x-forms.input wire:model="first_name" id="first_name" label="First Name"/>
      <x-forms.input wire:model="last_name" id="last_name" label="Last Name"/>
      <x-forms.input wire:model="email" id="email" label="Email"/>
      <x-forms.input wire:model="address" id="address" label="Address"/>
      <x-forms.input wire:model="post_code" id="post_code" label="Post Code"/>
      <x-forms.input wire:model="account_name" id="account_name" label="Account Name"/>
      <x-forms.input wire:model="short_code" id="short_code" label="Short Code"/>
      <x-forms.input wire:model="account_number" id="account_number" label="Account Number"/>
    </div>

    @if($worker?->active)
      <div wire:click="deactivate" class="flex items-center gap-2 text-sm text-error cursor-pointer">
        <x-icon-delete class="w-4 h-4"/>
        Deactivate Worker
      </div>
    @else
      <div wire:click="activate" class="flex items-center gap-2 text-sm text-success cursor-pointer">
        <x-uiw-circle-check-o class="w-4 h-4"/>
        Activate Worker
      </div>
    @endif


    <div class="modal-action m-0 w-full">
      <div class="flex justify-center gap-5 w-full">
        <x-forms.button text="Cancel" wire:click="hide" class="w-full" :is-secondary="true"/>
        <x-forms.button text="Update" wire:target="update" type="submit" class="w-full"/>
      </div>
    </div>
  </form>
</x-modals.base-modal>
