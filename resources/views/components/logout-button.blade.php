<div data-modal-id="modal-logout"
     class="flex justify-between items-center rounded-lg cursor-pointer p-2 hover:bg-base-300">
  <div class="flex items-center gap-2">
    <img class="w-7 h-7 rounded-xl" src="{{ auth()->user()->photo }}" alt=""/>

    <div class="select-none">
      <h3 class="text-sm text-accent font-medium">{{ auth()->user()->name }}</h3>
      <h4 class="text-xs text-neutral">{{ auth()->user()->email }}</h4>
    </div>
  </div>
  <x-icon-logout class="text-secondary w-5 h-5"/>
</div>
