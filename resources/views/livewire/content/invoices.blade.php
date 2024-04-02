<section x-show="content"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="flex flex-col gap-4 w-full p-6 relative  sm:h-screen  md:gap-6">

  <x-loader/>

  <div class="flex flex-col justify-between mb-2  sm:mb-0 sm:flex-row">
    <h1 class="text-2xl text-accent font-bold mb-4  sm:mb-0">Submitted Invoices</h1>
    <x-forms.button wire:click="exportCSV" text="Export CSV"
                    :icon="svg('heroicon-c-bars-arrow-down', 'w-4 mr-2')"
                    :is-secondary="true"/>
  </div>

  <div class="border rounded-xl px-3 pt-6 pb-2">

    <div class="flex flex-col justify-between gap-0 md:flex-row md:gap-5">
      <div class="flex flex-col gap-2 px-[2px] mb-2 md:mb-6  xl:flex-row">
        <div class="grid gap-2  sm:grid-cols-3">
          <x-forms.toggle id="thisMonth" text="This month" :active="$activeFilter"/>
          <x-forms.toggle id="previousMonth" text="Previous month" :active="$activeFilter"/>
          <x-forms.toggle id="thisYear" text="This year" :active="$activeFilter"/>
        </div>

        <div class="flex gap-2">
          <button class="fp-calender range inline-flex justify-center items-center gap-3 text-xs text-secondary font-medium border
                           border-neutral-content rounded-lg p-3 h-[42px]  hover:bg-base-200  sm:text-sm">
            @if($fromDate || $toDate)
              {{ $fromDate }} {{ $toDate ? " to $toDate" : '' }}
            @else
              Select period
              <x-icon-calendar/>
            @endif
          </button>
          @if($fromDate || $toDate)
            <button wire:click="clearDateRange">
              <x-uiw-circle-close-o class="w-5 text-secondary/50 hover:text-secondary"/>
            </button>
          @endif
          <input wire:model.live="fromDate" id="fromDate" type="hidden"/>
          <input wire:model.live="toDate" id="toDate" type="hidden"/>
        </div>
      </div>

      <div class="flex items-center justify-end gap-4 px-[2px] mb-6">
        <h3 class="text-sm text-secondary whitespace-nowrap">Sort by</h3>
        <select wire:model.live="orderBy" class="selectize bg-transparent w-[200px]" aria-label="sort by">
          <option value="id">Invoice ID</option>
          <option value="created_at">Date</option>
          <option value="shifts_sum_total">Amount</option>
          <option value="status">Status</option>
        </select>
      </div>
    </div>

    <x-tables.invoices :latestInvoices="$latestInvoices"
                       class="sm:max-h-[calc(100vh-18.5rem)]
                              md:max-h-[calc(100vh-16.5rem)]
                              xl:max-h-[calc(100vh-13.5rem)]"/>
  </div>
</section>
