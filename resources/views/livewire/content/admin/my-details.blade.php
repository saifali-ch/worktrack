<section x-show="content"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="flex flex-col gap-6 p-6 w-full relative  lg:h-screen">

  <h1 class="text-2xl text-accent font-bold mb-4  sm:mb-0">My Details</h1>

  <div class="sm:w-3/4">
    <livewire:components.profile :is-update="true"/>
  </div>

  <div class="lg:absolute lg:right-6 lg:bottom-6">
    <x-forms.button text="Save" type="button" class="w-[165px]" @click="$dispatch('saveProfile')"/>
  </div>
</section>
