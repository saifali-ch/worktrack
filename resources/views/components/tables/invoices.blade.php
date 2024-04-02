<div>
  <livewire:components.invoice-preview/>

  <div class="overflow-y-scroll {{ $class }}" tabindex="-1">
    <table class="hidden sm:table table-sm  md:table-md">
      <thead class="sticky top-0">
      <tr class="text-xs text-secondary select-none border-0">
        <th class="bg-base-200 rounded-l-xl">ID</th>
        <th class="bg-base-200">Date</th>
        <th class="bg-base-200">Amount</th>
        <th class="bg-base-200">Status</th>
        <th class="bg-base-200 rounded-r-xl"></th>
      </tr>
      </thead>
      <tbody>
      @foreach($latestInvoices as $invoice)
        <tr class="text-sm cursor-default hover:bg-base-200">
          <td>{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</td>
          <td>{{ $invoice->created_at->format('F d, Y') }}</td>
          <td>{{ $invoice->amount }}</td>
          <td>
            @if($invoice->status === 'Paid')
              <span class="text-success bg-success-content rounded-xl px-4 py-1">Paid</span>
            @else
              <span class="text-error bg-error-content rounded-xl px-4 py-1">Not Paid</span>
            @endif
          </td>
          <td>
            <div class="flex justify-end gap-6 cursor-pointer">
              <a href="{{ route('invoices.download', $invoice) }}">
                <x-heroicon-o-arrow-down-tray class="text-secondary w-4 h-4"/>
              </a>
              <x-heroicon-o-arrow-right wire:click="dispatch('showInvoicePreview', ['{{ $invoice->id }}'])"
                                        class="text-secondary w-4 h-4"/>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

  <div class="overflow-scroll max-h-[calc(100vh-15rem)] sm:hidden">
    @foreach($latestInvoices as $invoice)
      <div class="flex justify-between items-center border-b p-3">
        <div class="flex flex-col gap-3">
          <h3 class="text-sm text-accent">{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</h3>
          <h3 class="text-sm text-accent font-medium">{{ $invoice->amount }}</h3>
          <h3 class="text-sm text-neutral">{{ $invoice->created_at->format('F d, Y') }}</h3>
        </div>
        <div class="flex gap-8">
          @if($invoice->status === 'Paid')
            <span class="text-xs text-success bg-success-content rounded-xl px-4 py-1">Paid</span>
          @else
            <span class="text-xs text-error bg-error-content rounded-xl px-4 py-1">Not Paid</span>
          @endif
            <x-heroicon-o-arrow-right wire:click="dispatch('showInvoicePreview', ['{{ $invoice->id }}'])"
                                      class="w-5 h-5"/>
        </div>
      </div>
    @endforeach
  </div>
</div>

