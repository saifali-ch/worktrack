<section x-show="content"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="flex flex-col gap-4 w-full p-6  sm:h-screen  md:gap-6">

  <livewire:modals.worker.add-worker/>
  <livewire:modals.worker.edit-worker/>
  <livewire:modals.worker.delete-worker/>

  <div class="flex flex-col justify-between mb-2  sm:mb-0 sm:flex-row">
    <h1 class="text-2xl text-accent font-bold mb-4  sm:mb-0">Worker</h1>
    <div class="flex gap-6">
      <x-forms.button wire:click="exportCSV" text="Export CSV" class="w-full sm:w-fit sm:px-7"
                      :icon="svg('heroicon-c-bars-arrow-down', 'w-4 mr-2')"
                      :is-secondary="true"/>
      <x-forms.button wire:click="dispatch('showModal', ['add-worker'])" wire:target=""
                      text="Add Worker" class="w-full sm:w-fit sm:px-7"
                      :icon="svg('heroicon-c-plus', 'w-4')"/>
    </div>
  </div>

  <div class="border rounded-xl px-3 pt-6 pb-2">

    <div class="flex flex-col justify-between gap-0 md:flex-row md:gap-5">
      <div class="flex px-[2px] mb-2 md:mb-6">
        <button wire:click="activated"
                :class="{ 'bg-primary text-white' : $wire.active === true }"
                class="text-secondary text-xs sm:text-sm font-medium
                       border border-neutral-content focus-visible:border-secondary focus:outline-none
                       rounded-l-lg h-[42px] w-full sm:w-fit sm:px-7 bg-base-200 border-transparent">
          <x-uiw-loading wire:loading wire:target="activated" class="animate-spin w-3 h-3 mr-1"/>
          Active workers
        </button>
        <button wire:click="deactivated"
                :class="{ 'bg-primary text-white' : $wire.active === false }"
                class="text-secondary text-xs sm:text-sm font-medium
                       border border-neutral-content focus-visible:border-secondary focus:outline-none
                       rounded-r-lg h-[42px] w-full sm:w-fit sm:px-7 bg-base-200 border-transparent">
          <x-uiw-loading wire:loading wire:target="deactivated" class="animate-spin w-3 h-3 mr-1"/>
          Deactivated Workers
        </button>
      </div>

      <div class="flex items-center justify-end gap-4 px-[2px] mb-6">
        <h3 class="text-sm text-secondary whitespace-nowrap">Sort by</h3>
        <select wire:model.live="orderBy" class="selectize bg-transparent w-full sm:w-[200px]" aria-label="sort by">
          <option value="first_name">Worker Name</option>
          <option value="email">Email</option>
          <option value="address">Address</option>
        </select>
      </div>
    </div>

    <x-tables.workers :workers="$workers" class="md:max-h-[calc(100vh-13.7rem)]"/>
  </div>
</section>
