<form action="{{ route('password.email') }}" method="POST">
  @csrf
  <dialog wire:ignore.self id="modal-forgot-password" class="modal modal-bottom sm:modal-middle w-[391px] mx-auto"
          x-data>
    <div class="modal-box px-6 py-8">
      <div tabindex="-1"></div>
      <div class="flex flex-col justify-center items-center gap-5">
        <h2 class="text-2xl text-accent font-bold">Reset Password</h2>

        <div class="flex flex-col gap-5 w-full">
          <p class="text-xs text-secondary text-center">
            Enter your email address, and we’ll email you with instructions to reset your password
          </p>
          <x-forms.input label="Email" name="email"/>
        </div>

        <div class="modal-action m-0 w-full">
          <form method="dialog">
            <div class="flex justify-center gap-5 w-full">
              <x-forms.button text="Cancel" @click="closeModal('modal-forgot-password')"
                              class="w-full" :is-secondary="true"/>
              <x-forms.button text="Reset" @click="closeModal('modal-forgot-password')"
                              type="submit" class="w-full"/>
            </div>
          </form>
        </div>
      </div>
    </div>
  </dialog>
</form>
