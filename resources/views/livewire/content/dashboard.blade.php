<section x-show="content"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="flex flex-col gap-4 p-6 w-full  sm:h-screen  md:gap-6">

  <div class="flex flex-col justify-between mb-2  sm:mb-0 sm:flex-row">
    <h1 class="text-2xl text-accent font-bold mb-4  sm:mb-0">Hello, {{ $user->first_name }}!</h1>
  </div>

  <div class="grid grid-cols-1 gap-4  md:grid-cols-2 md:gap-6">

    <div class="bg-background rounded-xl p-4 md:p-6">
      <div class="bg-white rounded-full w-fit p-2 mb-5">
        <x-icon-total-invoice class="w-4 h-4"/>
      </div>
      <h4 class="text-xs textarea-secondary mb-2">Total Invoices</h4>
      <div class="flex justify-between">
        <h2 class="text-2xl text-accent">{{ $totalIncome }}</h2>
        <div class="text-xs textarea-secondary bg-white rounded-md p-2">{{ $totalInvoices }} Invoices</div>
      </div>
    </div>

    <div class="bg-background rounded-xl p-4 md:p-6">
      <div class="bg-white rounded-full w-fit p-2 mb-5">
        <x-icon-income class="w-4 h-4"/>
      </div>
      <h4 class="text-xs textarea-secondary mb-2">Income This Month</h4>
      <div class="flex justify-between">
        <h2 class="text-2xl text-accent">{{ $currentMonthIncome }}</h2>
        @if($growth > 0)
          <div class="inline-flex gap-2 text-xs textarea-secondary text-success bg-success-content rounded-md p-2">
            <x-heroicon-o-arrow-up-right class="text-success w-4 h-4"/>
            {{ $growth }}%
          </div>
        @else
          <div class="inline-flex gap-2 text-xs textarea-secondary text-error bg-error-content rounded-md p-2">
            <x-heroicon-o-arrow-down-right class="text-error w-4 h-4"/>
            {{ $growth }}%
          </div>
        @endif
      </div>
    </div>

  </div>

  <div class="border rounded-xl px-3 pt-3 pb-2  md:pt-6">

    <div class="flex justify-between px-3 mb-3  md:mb-6">
      <h3 class="text-sm text-accent font-medium select-none">Latest Invoices</h3>
      <button wire:click="dispatch('changePage', ['invoices'])"
              class="text-sm text-secondary font-medium underline">
        See All
      </button>
    </div>

    <x-tables.invoices :latestInvoices="$latestInvoices"
                       class="sm:max-h-[calc(100vh-29rem)] md:max-h-[calc(100vh-22.7rem)]"/>
  </div>
</section>
