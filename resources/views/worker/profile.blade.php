<x-layouts.app>
  <section class="flex lg:max-h-screen">

    <section class="hidden h-screen p-4 pr-0  lg:block lg:w-4/12">
      <img class="w-full h-full" src="{{ Vite::image('login-background.png') }}" alt="banner">
    </section>

    <section class="flex flex-col justify-between p-6 w-full h-screen overflow-y-scroll  sm:p-10  lg:w-8/12">
      <div class="pb-4">
        <h2 class="text-2xl font-bold  md:text-3xl">Welcome, {{ auth()->user()->first_name }}!</h2>
        <p class="text-xs text-secondary py-1  md:text-sm">
          It looks like this is your first time logging into {{ config('app.company_name') }}.
          Please complete your information below to get your profile setup:
        </p>
      </div>
      <livewire:components.profile :actions="true"/>
    </section>

  </section>
</x-layouts.app>
