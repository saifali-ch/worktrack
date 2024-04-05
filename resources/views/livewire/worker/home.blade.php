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
    <livewire:components.sidebar wire:model.live="currentPage"/>
  </div>

  <livewire:components.sidebar wire:model.live="currentPage" class="hidden lg:flex"/>

  <div class="w-full lg:w-9/12 xl:w-10/12 relative">
    <x-loader/>

    @if($currentPage === 'dashboard')
      <livewire:content.dashboard wire:key="content-dashboard"/>
    @elseif($currentPage === 'invoices')
      <livewire:content.invoices wire:key="content-invoices"/>
    @elseif($currentPage === 'create-invoice')
      <livewire:content.create-invoice wire:key="content-create-invoice"/>
    @elseif($currentPage === 'my-details')
      <livewire:content.my-details wire:key="content-my-details"/>
    @endif
  </div>

  <x-modals.logout/>

</section>
