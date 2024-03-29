<section class="flex justify-between h-screen">

  <section class="flex flex-col w-full gap-40 p-6
                  xs:w-[420px]
                  md:w-5/12 md:p-[40px]
                  lg:w-5/12 lg:p-[70px] lg:gap-0 lg:justify-between
                  xl:w-4/12">
    <x-logo/>

    <div class="flex flex-col gap-5  md:gap-8">
      <h2 class="font-bold text-2xl  md:text-3xl  lg:text-4xl">Login</h2>
      <p class="text-sm text-secondary">Enter your email address and we will email you a magic link to login.</p>
      <x-forms.input label="Email"/>
      <x-forms.button text="Send login link"/>
    </div>

    <!-- Following empty div is mandatory for alignment -->
    <div></div>
  </section>

  <section class="hidden p-4  md:block md:w-6/12  lg:w-6/12 xl:w-7/12">
    <img class="h-full w-full" src="{{ Vite::image('login-background.png') }}" alt="banner">
  </section>

</section>
