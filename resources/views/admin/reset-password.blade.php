<x-layouts.app>
  <section class="flex justify-between h-screen">
    <section class="flex flex-col w-full gap-40 p-6
                  xs:w-[420px]
                  md:w-5/12 md:p-[40px]
                  lg:w-5/12 lg:p-[70px] lg:gap-0 lg:justify-between
                  xl:w-4/12">
      <x-logo/>
      <div class="flex flex-col gap-5  md:gap-8">
        <h2 class="font-bold text-2xl text-accent  md:text-3xl  lg:text-4xl">Reset Password</h2>

        <form action="{{ route('password.update') }}" method="POST" class="flex flex-col gap-5">
          @csrf
          <input type="hidden" name="token" value="{{ request()->token }}">
          <x-forms.input type="email" name="email" label="Email" value="{{ request()->email }}" readonly/>
          <x-forms.input type="password" name="password" label="Password"/>
          <x-forms.input type="password" name="password_confirmation" label="Confirm Password"/>
          <x-forms.button type="submit" text="Reset" class="px-7"/>
        </form>

      </div>
      <!-- Following empty div is mandatory for alignment -->
      <div></div>
    </section>
    <section class="hidden p-4  md:block md:w-6/12  lg:w-6/12 xl:w-7/12">
      <img class="h-full w-full" src="{{ Vite::image('admin/login-background.png') }}" alt="banner">
    </section>
  </section>
</x-layouts.app>
