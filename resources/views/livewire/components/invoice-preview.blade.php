<dialog wire:ignore.self id="modal-invoice-preview" class="modal modal-bottom  lg:modal-middle">
  <div class="modal-box flex justify-center px-1  sm:px-6  lg:min-w-[23cm]">
    <div tabindex="-1"></div>
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
        <x-uiw-close @click="reset" class="w-4"/>
      </button>
    </form>

    <main x-data="invoice({{ json_encode($sites) }})"
          class="flex flex-col gap-6 pt-6 px-3 overflow-x-scroll">

      <div class="flex flex-col justify-between items-center sm:flex-row">
        <h1 class="text-2xl text-accent font-bold mb-4  sm:mb-0">
          Invoice {{ $invoice?->padded_id }}
        </h1>
        <a href="{{ route('invoices.download', $invoice ?? 0) }}">
          <x-forms.button text="Download PDF" :icon="svg('uiw-download', 'w-4 mr-2')" :is-secondary="true"/>
        </a>
      </div>

      <div class="overflow-scroll" tabindex="-1">
        <div class="bg-white border border-neutral-content rounded-xl px-4 py-8 w-[17cm]  sm:w-full lg:w-[21cm]">
          <table class="table">
            <tr class="border-none">
              <td class="text-xs text-secondary align-baseline w-[100px] p-0 pb-2">Full Name:</td>
              <td class="text-sm text-accent align-baseline p-0 pb-2">{{ $user->name }}</td>
              <td class="text-xs text-secondary align-baseline w-[100px] p-0">Invoice ID</td>
              <td class="text-sm text-accent font-medium text-end align-baseline p-0">{{ $invoice?->padded_id }}</td>
            </tr>
            <tr class="border-none">
              <td class="text-xs text-secondary align-baseline w-[100px] p-0 pb-2">Address:</td>
              <td class="text-sm text-accent align-baseline p-0 w-[300px] pb-2">{{ $user->address }}</td>
              <td class="text-xs text-secondary align-baseline w-[100px] p-0">Invoice Date</td>
              <td
                class="text-sm text-accent font-medium text-end align-baseline w-[150px] p-0">{{ $invoice?->created_at->format('F d, Y') }}</td>
            </tr>
            <tr class="border-none">
              <td class="text-xs text-secondary align-baseline w-[100px] p-0 pb-2">Post Code:</td>
              <td class="text-sm text-accent align-baseline p-0 pb-2">{{ $user->post_code }}</td>
            </tr>
            <tr class="border-none">
              <td class="text-xs text-secondary align-baseline w-[100px] p-0 pb-2">To:</td>
              <td class="text-sm text-accent align-baseline p-0 pb-2">Ablou Facilities Ltd</td>
            </tr>
          </table>

          @foreach($shifts ?? [] as $shift)
            <section class="my-8">
              <h3 class="text-sm text-accent font-medium bg-base-200 rounded-xl px-4 py-3">
                Shift {{ $loop->iteration }}
              </h3>
              <div class="grid grid-cols-4 gap-10 border-dashed border-b-[1px] border-neutral-content py-4 mx-4">
                <div>
                  <h4 class="text-xs text-secondary">Date</h4>
                  <h3 class="text-sm text-accent">{{ $shift->date->format('F d, Y') }}</h3>
                </div>
                <div>
                  <h4 class="text-xs text-secondary">Site</h4>
                  <h3 class="text-sm text-accent">{{ $shift->site->name }}</h3>
                </div>
                <div>
                  <h4 class="text-xs text-secondary">Start</h4>
                  <h3 class="text-sm text-accent">{{ $shift->start_time->format('h:i A') }}</h3>
                </div>
                <div>
                  <h4 class="text-xs text-secondary">Finish</h4>
                  <h3 class="text-sm text-accent">{{ $shift->finish_time->format('h:i A') }}</h3>
                </div>
              </div>
              <div class="flex flex-col gap-3 px-4 pt-4">
                <div class="flex justify-end items-center gap-4">
                  <h4 class="text-xs text-secondary">Rate:</h4>
                  <h3 class="text-sm text-accent">{{ \Illuminate\Support\Number::currency($shift->rate, 'GBP') }}</h3>
                </div>
                <div class="flex justify-end items-center gap-4">
                  <h4 class="text-xs text-secondary font-medium">Total:</h4>
                  <h3
                    class="text-sm text-accent font-medium">{{ \Illuminate\Support\Number::currency($shift->total, 'GBP') }}</h3>
                </div>
              </div>
            </section>
          @endforeach

          <div class="flex justify-between border-t-[1px] border-black py-8 mx-4">
            <h3 class="text-xs text-secondary font-medium">Total:</h3>
            <h2 class="text-lg text-accent font-medium">{{ $total }}</h2>
          </div>
          <div class="border-dashed border-t-[1px] pt-8 mx-4">
            <h2 class="text-sm text-accent font-medium pb-4">Bank details</h2>
            <table>
              <tr class="">
                <td class="text-xs text-secondary w-[130px] pb-4">Acc Name:</td>
                <td class="text-sm text-accent pb-4">{{ $user->account_name }}</td>
              </tr>
              <tr class="">
                <td class="text-xs text-secondary w-[130px] pb-4">Sort Code:</td>
                <td class="text-sm text-accent pb-4">{{ $user->short_code }}</td>
              </tr>
              <tr class="">
                <td class="text-xs text-secondary w-[130px] pb-4">Account Number:</td>
                <td class="text-sm text-accent pb-4">{{ $user->account_number }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>
</dialog>
