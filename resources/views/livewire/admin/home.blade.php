<section x-data="{ content: true }" class="flex flex-col  lg:flex-row">

  <header x-show="content" x-cloak class="flex justify-between p-3 lg:hidden">
    <div class="flex items-center gap-4">
      <x-heroicon-c-bars-3 @click="content = false" class="w-6 h-6"/>
      <h2 class="text-lg text-accent font-medium">Dashboard</h2>
    </div>
    <img class="w-[60px] h-7" src="{{ Vite::image('logo.svg') }}" alt="logo">
  </header>

  <div x-show="!content" x-cloak
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0 transform scale-90"
       x-transition:enter-end="opacity-100 transform scale-100"
       x-transition:leave="transition ease-in duration-100"
       x-transition:leave-start="opacity-100 transform scale-100"
       x-transition:leave-end="opacity-0 transform scale-90">
    <x-heroicon-o-x-mark @click="content = true" class="m-3 w-7 h-7"/>
    <livewire:components.admin.sidebar wire:model.live="currentPage"/>
  </div>

  <livewire:components.admin.sidebar wire:model.live="currentPage" class="hidden lg:flex"/>

  <div class="w-full lg:w-9/12 xl:w-10/12 relative">
    <div wire:loading.flex
         wire:target="currentPage"
         class="absolute h-screen left-0 right-0 flex justify-center items-center bg-white bg-opacity-75 z-10">
      <div class="loader"></div>
    </div>

    @if($currentPage === 'sites')
      <livewire:content.admin.sites :current-page="$currentPage"/>
    @elseif($currentPage === 'workers')
      <livewire:content.admin.workers :current-page="$currentPage"/>
    @elseif($currentPage === 'my-details')
      <livewire:content.admin.my-details :current-page="$currentPage"/>
    @endif
  </div>

  <x-modals.logout/>

</section>
