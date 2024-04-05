<dialog id="modal-invoice-submitted" class="modal modal-bottom sm:modal-middle">
  <div class="modal-box flex flex-col justify-center items-center gap-6 px-9 py-14">
    <x-icon-check/>
    <h2 class="text-2xl text-accent font-bold">Thank you!</h2>
    <p class="text-sm text-secondary text-center w-[260px]">
      Your invoice has been submitted for processing and emailed to you.
    </p>
    <div class="modal-action m-0">
      <form method="dialog">
        <div class="flex justify-center gap-4">
          <x-forms.button text="To the submitted invoices" type="" class="" :is-secondary="true"/>
        </div>
      </form>
    </div>
  </div>
</dialog>
