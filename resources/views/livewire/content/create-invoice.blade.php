<section x-show="content" x-data="invoice({{ json_encode($sites) }})"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-90"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-90"
         class="flex flex-col justify-between w-full  sm:h-screen">

  <div class="flex w-full border-b border-b-neutral-content">
    <section class="w-full xl:w-1/2">
      <div class="flex flex-col gap-2 border-b border-neutral-content p-6">
        <h2 class="text-2xl text-accent font-bold">New Invoice</h2>
      </div>

      <div class="flex flex-col gap-3 border-b border-neutral-content p-6">
        <h4 class="text-sm text-secondary font-medium">Note:</h4>
        <ul class="list-disc pl-4">
          <li class="text-sm text-secondary">Only submit one invoice per week.</li>
          <li class="text-sm text-secondary">Only include shifts from last week.</li>
          <li class="text-sm text-secondary">Submit your invoice by 9am on Wednesday else payment could be delayed.</li>
        </ul>
      </div>

      <section id="shifts" class="flex flex-col gap-4 p-6 overflow-y-scroll h-[calc(100vh-18.4rem)]" tabindex="-1">
        <section>
          <div class="border border-neutral-content rounded-xl">
            <div class="flex justify-between bg-base-200 rounded-t-xl p-4">
              <h3 class="text-sm text-accent font-medium">My Details</h3>
              <button wire:click="dispatch('changePage', ['my-details'])"
                      class="inline-flex gap-1 text-sm text-secondary underline">
                <x-icon-writing class="w-5 h-5"/>
                Edit details
              </button>
            </div>
            <div class="px-4 py-7">
              <table class="table">
                <tbody>
                <tr class="border-none">
                  <td class="w-[130px] text-xs text-secondary align-baseline p-0 pb-2">Full Name:</td>
                  <td
                    class="text-sm text-accent align-baseline p-0 pb-2">{{ $user->name }}</td>
                </tr>
                <tr class="border-none">
                  <td class="w-[130px] text-xs text-secondary align-baseline p-0 pb-2">Address:</td>
                  <td class="text-sm text-accent align-baseline p-0 pb-2">{{ $user->address }}</td>
                </tr>
                <tr class="border-none">
                  <td class="w-[130px] text-xs text-secondary align-baseline p-0 pb-2">Post Code:</td>
                  <td class="text-sm text-accent align-baseline p-0 pb-2">{{ $user->post_code  }}</td>
                </tr>
                <tr class="border-none">
                  <td class="w-[130px] text-xs text-secondary align-baseline p-0 pb-2">Acc Name:</td>
                  <td class="text-sm text-accent align-baseline p-0 pb-2">{{ $user->account_name }}</td>
                </tr>
                <tr class="border-none">
                  <td class="w-[130px] text-xs text-secondary align-baseline p-0 pb-2">Acc Name:</td>
                  <td class="text-sm text-accent align-baseline p-0 pb-2">{{ $user->account_name }}</td>
                </tr>
                <tr class="border-none">
                  <td class="w-[130px] text-xs text-secondary align-baseline p-0 pb-2">Sort Code:</td>
                  <td class="text-sm text-accent align-baseline p-0 pb-2">{{ $user->short_code }}</td>
                </tr>
                <tr class="border-none">
                  <td class="w-[130px] text-xs text-secondary align-baseline p-0 pb-2">Account Number:
                  </td>
                  <td class="text-sm text-accent align-baseline p-0 pb-2">
                    {{ $user->redacted_account_number }}
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </section>

        @foreach($shifts as $index => $shift)
          <section class="shift">
            <div class="border border-neutral-content rounded-xl">
              <div class="flex  justify-between bg-base-200 rounded-t-xl p-4">
                <h3 class="text-sm text-accent font-medium">Shift {{ $loop->iteration }}</h3>
                <button wire:click="removeShift({{ $index }})"
                        class="inline-flex gap-1 text-sm text-secondary underline">
                  <x-heroicon-o-trash class="w-4 h-4"/>
                  Remove shift
                </button>
              </div>
              <div class="flex flex-col gap-4 px-4 py-7">
                <div class="w-full md:w-1/2">
                  <x-forms.input wire:model="shifts.{{ $index }}.date"
                                 label="Shift Date" type="date"
                                 class="fp-calender cursor-pointer"
                                 required/>
                  @error('shifts.'.$index.'.date')<span class="text-xs text-error mt-1">{{ $message }}</span>@enderror
                </div>

                <div>
                  <label for="site_id.{{ $index }}" class="text-secondary text-xs mb-1">Site</label>
                  <select wire:model="shifts.{{ $index }}.site_id" id="site_id.{{ $index }}"
                          class="selectize w-full mt-1">
                    @foreach($sites as $site)
                      <option @selected($site->id === $shifts[$index]['site_id']) value="{{ $site->id }}">
                        {{ $site->name }}
                      </option>
                    @endforeach
                  </select>
                  @error('shifts.'.$index.'.site_id')<span class="text-xs text-error">{{ $message }}</span>@enderror
                </div>


                <div class="grid md:grid-cols-2 gap-4">
                  <div>
                    <x-forms.input wire:model="shifts.{{ $index }}.start_time" label="Start Time"
                                   class="fp-time cursor-pointer"/>
                    @error('shifts.'.$index.'.start_time')
                    <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                  </div>

                  <div>
                    <x-forms.input wire:model="shifts.{{ $index }}.finish_time" label="Finish Time"
                                   class="fp-time cursor-pointer"/>
                    @error('shifts.'.$index.'.finish_time')
                    <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                  </div>

                  <div>
                    <x-forms.input wire:model="shifts.{{ $index }}.rate" label="Rate" class="currency"/>
                    @error('shifts.'.$index.'.rate')
                    <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                  </div>

                  <div>
                    <x-forms.input wire:model="shifts.{{ $index }}.total" label="Total" class="currency"/>
                    @error('shifts.'.$index.'.total')
                    <span class="text-xs text-error mt-1">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
          </section>
        @endforeach

        <button wire:click="addShift"
                class="inline-flex text-sm text-secondary font-medium border border-neutral-content rounded-xl w-fit p-3  hover:bg-base-200">
          <x-heroicon-m-plus-small class="w-5 h-5"/>
          @if(count($shifts) === 0)
            Add a shift
          @else
            Add another shift
          @endif
        </button>
      </section>
    </section>

    <section class="hidden xl:flex flex-col gap-6 bg-base-200 w-1/2 p-6">
      <div>
        <h3 class="text-sm text-accent font-medium mb-4">Preview</h3>
        <p class="text-sm text-secondary">Please check your shifts before confirming. By submitting you are confirming
          these are an accurate report of
          your shifts worked. Any errors could mean a delay in payment.</p>
      </div>


      <div class="overflow-x-scroll h-[calc(100vh-15rem)]">
        <div class="bg-white rounded-md px-4 py-8 w-full min-h-[29.7cm]">
          <section class="grid gap-[54px] px-4">
            <table class="table">
              <tr class="border-none">
                <td class="text-xs text-secondary align-baseline w-[100px] p-0 pb-2">Full Name:</td>
                <td class="text-sm text-accent align-baseline p-0 pb-2">{{ $user->name }}</td>
                <td class="text-xs text-secondary align-baseline w-[100px] p-0">Invoice ID</td>
                <td class="text-sm text-accent font-medium text-end align-baseline p-0">
                  {{ str_pad($nextInvoiceId, 5, '0', STR_PAD_LEFT) }}
                </td>
              </tr>
              <tr class="border-none">
                <td class="text-xs text-secondary align-baseline w-[100px] p-0 pb-2">Address:</td>
                <td class="text-sm text-accent align-baseline p-0 w-[300px] pb-2">{{ $user->address }}</td>
                <td class="text-xs text-secondary align-baseline w-[100px] p-0">Invoice Date</td>
                <td
                  class="text-sm text-accent font-medium text-end align-baseline w-[150px] p-0">{{ now()->format('F d, Y') }}</td>
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
          </section>
          <template x-for="(shift, index) in $wire.shifts">
            <section class="my-8">
              <h3 class="text-sm text-accent font-medium bg-base-200 rounded-xl px-4 py-3"
                  x-text="'Shift ' + (index + 1)"></h3>
              <div class="grid grid-cols-4 gap-10 border-dashed border-b-[1px] border-neutral-content py-4 mx-4">
                <div>
                  <h4 class="text-xs text-secondary">Date</h4>
                  <h3 class="text-sm text-accent"
                      x-text="formatDate(shift.date)"
                  />
                </div>
                <div>
                  <h4 class="text-xs text-secondary">Site</h4>
                  <h3 class="text-sm text-accent" x-text="getSiteName(shift.site_id)"/>
                </div>
                <div>
                  <h4 class="text-xs text-secondary">Start</h4>
                  <h3 class="text-sm text-accent" x-text="shift.start_time"/>
                </div>
                <div>
                  <h4 class="text-xs text-secondary">Finish</h4>
                  <h3 class="text-sm text-accent" x-text="shift.finish_time"/>
                </div>
              </div>
              <div class="flex flex-col gap-3 px-4 pt-4">
                <div class="flex justify-end gap-4">
                  <h4 class="text-xs text-secondary">Rate:</h4>
                  <h3 class="text-sm text-accent" x-text="removeGBP(shift.rate)"/>
                </div>
                <div class="flex justify-end gap-4">
                  <h4 class="text-xs text-secondary font-medium">Total:</h4>
                  <h3 class="text-sm text-accent font-medium" x-text="removeGBP(shift.total)"/>
                </div>
              </div>
            </section>
          </template>

          <div class="flex justify-between border-t-[1px] border-black py-8 mx-4">
            <h3 class="text-xs text-secondary font-medium">Total:</h3>
            <h2 class="text-lg text-accent font-medium" x-text="total($wire.shifts)"/>
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
                <td class="text-sm text-accent pb-4">{{ $user->redacted_account_number }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="flex justify-between px-6 py-4 sm:py-0">
    <x-forms.button @click="clearInvoice" text="Clear / Start Over" :is-secondary="true"/>

    <div class="flex gap-4">
      <x-forms.button data-modal-id="modal-invoice-confirmation" wire:target="submitInvoice"
                      wire:loading.attr="disabled"
                      :disabled="count($shifts) === 0"
                      text="Submit Invoice"/>
    </div>
  </div>

  <x-modals.invoice-confirmation/>
</section>
