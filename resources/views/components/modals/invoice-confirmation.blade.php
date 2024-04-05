<form wire:submit="submitInvoice">
  @csrf
  <x-modals.confirm id="modal-invoice-confirmation" message="Are you sure you want to submit this invoice?"/>
</form>
