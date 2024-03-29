<x-layouts.app>
  <section class="flex lg:max-h-screen">

    <section class="hidden h-screen p-4 pr-0  lg:block lg:w-4/12">
      <img class="w-full h-full" src="{{ Vite::image('login-background.png') }}" alt="banner">
    </section>

    <section class="flex flex-col justify-between p-6 w-full  sm:p-10  lg:w-8/12">
      <div class="pb-4">
        <h2 class="text-2xl font-bold  md:text-3xl">Welcome, {{ auth()->user()->first_name }}!</h2>
        <p class="text-xs text-secondary py-1  md:text-sm">
          It looks like this is your first time logging into {{ config('app.company_name') }}.
          Please complete your information below to get your profile setup:
        </p>
      </div>
      <div class="flex flex-col gap-6 lg:pr-[120px]">
        <div class="flex flex-col items-center  sm:flex-row">
          <div
              class="flex flex-col justify-center items-center text-xs text-accent
            border-[1.5px] border-dashed border-secondary bg-background
            rounded-xl w-[120px] h-[120px]  sm:w-[150px] sm:h-[150px] sm:text-sm">
            <x-heroicon-o-cloud-arrow-up class="w-5 h-5"/>
            Upload photo
          </div>
          <div class="text-xs text-neutral p-3  md:p-7">
            JPG, GIF or PNG. Max size of 800K
          </div>
        </div>
        <div class="flex flex-col gap-10 sm:flex-row">
          <div class="w-full sm:w-1/2 ">
            <h2 class="text-sm text-accent font-medium mb-5">Personal Information</h2>
            <div class="flex flex-col gap-3">
              <x-forms.input label="First Name"/>
              <x-forms.input label="Last Name"/>
              <x-forms.input label="Email" type="email"/>
              <x-forms.input label="Address"/>
              <x-forms.input label="Post Code"/>
            </div>
          </div>
          <div class="w-full sm:w-1/2">
            <h2 class="text-sm text-accent font-medium mb-5">Bank Details</h2>
            <div class="flex flex-col gap-3">
              <x-forms.input label="Account Name"/>
              <x-forms.input label="Sort Code"/>
              <x-forms.input label="Account Number"/>
            </div>
          </div>
        </div>
        <div class="flex gap-6 w-full  sm:w-1/2">
          <x-forms.button wire:target="save" text="Submit" type="submit"/>
          <x-forms.button wire:click="doItLater" text="I'll do it later" :is-secondary="true"/>
        </div>
      </div>
    </section>

  </section>
</x-layouts.app>
