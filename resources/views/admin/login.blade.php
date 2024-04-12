<x-layouts.app>
  <x-modals.forgot-password/>

  <section class="flex justify-between h-screen">
    <section class="flex flex-col w-full gap-40 p-6
                  xs:w-[420px]
                  md:w-5/12 md:p-[40px]
                  lg:w-5/12 lg:p-[70px] lg:gap-0 lg:justify-between
                  xl:w-4/12">
      <x-logo/>
      <div class="flex flex-col gap-5  md:gap-8">
        <h2 class="font-bold text-2xl text-accent  md:text-3xl  lg:text-4xl">Login</h2>

        @if(session('error'))
          <p class="text-sm text-error">{{ session('error') }}</p>
        @endif

        @if(session('status'))
          <p class="text-sm text-success">{{ session('status') }}</p>
        @endif

        <form method="POST" class="flex flex-col gap-5">
          @csrf
          <x-forms.input type="email" name="email" label="Email" required/>
          <x-forms.input type="password" name="password" label="Password" required/>
          <div data-modal-id="modal-forgot-password"
               class="text-xs text-neutral text-end underline cursor-pointer -mt-2">
            Forgot Password?
          </div>
          <x-forms.button type="submit" text="Login"/>
        </form>

        @error('throttle')
        <div class="w-3/2">
          <p class="text-sm text-error">{{ $message }}</p>
        </div>
        @enderror

      </div>
      <!-- Following empty div is mandatory for alignment -->
      <div></div>
    </section>
    <section class="hidden p-4  md:block md:w-6/12  lg:w-6/12 xl:w-7/12">
      <img class="h-full w-full" src="{{ Vite::image('admin/login-background.png') }}" alt="banner">
    </section>
  </section>
</x-layouts.app>
