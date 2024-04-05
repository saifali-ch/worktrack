<?php

namespace App\Livewire\Content;

use App\Models\Site;
use App\Models\User;
use App\Traits\Toast;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateInvoice extends Component
{
    use Toast;

    public User $user;
    public $sites;
    public $shifts = [];

    public $nextInvoiceId;

    public function mount() {
        $this->user = auth()->user();
        $this->sites = Site::orderBy('name')->get();
        $this->nextInvoiceId = $this->user->invoices()->count() + 1;
    }

    public function addShift() {
        $this->shifts[] = [
            'date' => '',
            'site_id' => '',
            'start_time' => '',
            'finish_time' => '',
            'rate' => '',
            'total' => ''
        ];
    }

    public function removeShift($index) {
        unset($this->shifts[$index]);
        $this->shifts = array_values($this->shifts); // reindex array
    }

    public function parseCurrency($value) {
        return (float)str_replace(['GBP £', ','], '', $value);
    }

    public function parseTime($value) {
        return date('h:i A', strtotime($value));
    }

    public function submitInvoice() {
        if (empty($this->shifts)) {
            $this->toast('error', 'You must add at least one shift');
            return;
        }

        $shifts = $this->shifts; // Temporarily store the shifts array in case of validation errors

        $this->shifts = collect($this->shifts)->map(function ($shift) {
            $shift['rate'] = $this->parseCurrency($shift['rate']);
            $shift['total'] = $this->parseCurrency($shift['total']);
            return $shift;
        })->toArray();

        try {
            $this->validate();

            $this->shifts = collect($this->shifts)->map(function ($shift) {
                $shift['user_id'] = $this->user->id;
                $shift['start_time'] = $this->parseCurrency($shift['start_time']);
                $shift['finish_time'] = $this->parseCurrency($shift['finish_time']);
                return $shift;
            })->toArray();

            DB::transaction(function () {
                $invoice = $this->user->invoices()->create();
                $invoice->shifts()->createMany($this->shifts);

//                $this->user->notify(new InvoiceCreated($invoice));
            });

            $this->clearInvoice();
            $this->toast('success', 'Your invoice has been submitted for processing and emailed to you');
            $this->dispatch('changePage', 'invoices');
        } catch (ValidationException $e) {
            $this->toast('error', 'There was an error submitting the invoice');

            $this->shifts = $shifts; // restore the original shifts array for frontend display
            throw $e; // rethrow the exception to display the error messages
        }
    }

    #[On('clearInvoice')]
    public function clearInvoice() {
        $this->clearValidation();
        $this->shifts = [];
    }

    public function rules() {
        return [
            'shifts.*.date' => 'required|date',
            'shifts.*.site_id' => 'required|exists:sites,id',
            'shifts.*.start_time' => 'required|date_format:h:i A',
            'shifts.*.finish_time' => 'required|date_format:h:i A',
            'shifts.*.rate' => 'required|numeric|min:1',
            'shifts.*.total' => 'required|numeric|min:1',
        ];
    }

    public function messages() {
        return [
            'shifts.*.date.required' => 'The shift date is required',
            'shifts.*.date.date' => 'The shift date must be a valid date',

            'shifts.*.site_id.required' => 'The site field is required',
            'shifts.*.site_id.exists' => 'The selected site is invalid',

            'shifts.*.start_time.required' => 'The start time is required',
            'shifts.*.start_time.date_format' => 'The start time must be a valid time format (h:i A)',

            'shifts.*.finish_time.required' => 'The finish time is required',
            'shifts.*.finish_time.date_format' => 'The finish time must be a valid time format (h:i A)',

            'shifts.*.rate.required' => 'The rate is required',
            'shifts.*.rate.numeric' => 'The rate must be a number',
            'shifts.*.rate.min' => 'The rate must be at least GBP £1.00',

            'shifts.*.total.required' => 'The total is required',
            'shifts.*.total.numeric' => 'The total must be a number',
            'shifts.*.total.min' => 'The total must be at least GBP £1.00',
        ];
    }

    public function render() {
        $this->dispatch('js:render');
        return view('livewire.content.create-invoice');
    }
}
