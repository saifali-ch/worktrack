@props(['showCloseButton' => false])

<dialog class="modal modal-bottom sm:modal-middle" :class="{ 'modal-open': $wire.visible }">
  <div class="modal-box px-6 py-8 sm:w-[391px]">

    @if($showCloseButton)
      <button @click="$wire.visible = false" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
        <x-uiw-close class="w-4"/>
      </button>
    @endif

    {{ $slot }}

  </div>
</dialog>
