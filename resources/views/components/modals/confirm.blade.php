@props(['id', 'message', 'actionText' => 'Yes', 'cancelText' => 'No'])

<dialog id="{{ $id }}" class="modal modal-bottom sm:modal-middle">
  <div class="modal-box flex flex-col justify-center items-center gap-10 px-9 py-14">
    <div tabindex="-1"></div>
    <p class="text-xl text-secondary text-center w-[260px]">{{ $message }}</p>
    <div class="modal-action m-0">
      <form method="dialog">
        <div class="flex justify-center gap-4">
          <x-forms.button text="{{ $cancelText }}" @click="closeModal('{{ $id }}')"
                          class="w-[161px]" :is-secondary="true"/>
          <x-forms.button text="{{ $actionText }}" @click="closeModal('{{ $id }}')"
                          type="submit" class="w-[161px]"/>
        </div>
      </form>
    </div>
  </div>
</dialog>
