<x-modals.base-modal>
  <form wire:submit="destroy" class="flex flex-col justify-center items-center gap-5">
    <x-uiw-question-circle-o class="w-16 text-primary"/>

    <p class="text-xl text-secondary text-center w-[260px]">
      Are you sure you want to delete this site?
    </p>

    <div class="modal-action m-0 w-full">
      <div class="flex justify-center gap-5 w-full">
        <x-forms.button text="Cancel" wire:click="hide" class="w-full" :is-secondary="true"/>
        <x-forms.button text="Delete" wire:target="destroy" type="submit" class="w-full"/>
      </div>
    </div>
  </form>
</x-modals.base-modal>
