<div>
  <div class="overflow-y-scroll {{ $class }}" tabindex="-1">
    <table class="hidden md:table md:table-md">
      <thead class="sticky top-0">
      <tr class="text-xs text-secondary select-none border-0">
        <td class="text-xs text-secondary font-normal bg-base-200 rounded-l-xl w-4/12">Worker Name</td>
        <td class="text-xs text-secondary font-normal bg-base-200 w-4/12">Email</td>
        <td class="text-xs text-secondary font-normal bg-base-200 w-3/12">Address</td>
        <td class="bg-base-200 rounded-r-xl w-3/12"></td>
      </tr>
      </thead>
      <tbody>
      @foreach($workers as $worker)
        <tr class="cursor-default hover:bg-base-200">
          <td class="text-sm text-accent w-4/12">{{ $worker->name }}</td>
          <td class="text-sm text-secondary w-4/12">{{ $worker->email }}</td>
          <td class="text-sm text-secondary w-3/12">{{ $worker->address }}</td>
          <td>
            <div class="flex justify-end gap-6 cursor-pointer">
              <x-icon-writing wire:click="dispatch('showModal', ['edit-worker', {{ $worker->id }}])"
                              class="text-secondary w-4 h-4 hover:text-blue-500"/>

              <x-icon-delete wire:click="dispatch('showModal', ['delete-worker', {{ $worker->id }}])"
                             class="text-secondary w-4 h-4 hover:text-red-500"/>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

  <table class="table md:hidden">
    <thead>
    <tr class="text-xs text-secondary select-none border-0">
      <td class="text-xs text-secondary font-normal bg-base-200 rounded-l-xl w-4/12">Worker Details</td>
      <td class="text-xs text-secondary text-end font-normal bg-base-200 rounded-r-lg w-4/12">Actions</td>
    </tr>
    </thead>
  </table>
  <div class="overflow-scroll max-h-[calc(100vh-15rem)]  sm:max-h-[calc(100vh-18.5rem)]  md:hidden">
    @foreach($workers as $worker)
      <div class="flex justify-between items-center border-b p-3">
        <div class="flex flex-col gap-3">
          <h3 class="text-sm text-accent">Audrey Rodriquez</h3>
          <h3 class="text-sm text-secondary">audrey.rodriquez@example.com</h3>
          <h3 class="text-sm text-secondary">(603) 245-4546</h3>
        </div>
        <div class="flex justify-end gap-2 cursor-pointer">
          <x-icon-writing wire:click="dispatch('showModal', ['edit-worker', {{ $worker->id }}])"
                          class="text-secondary w-4 h-4 hover:text-blue-500"/>

          <x-icon-delete wire:click="dispatch('showModal', ['delete-worker', {{ $worker->id }}])"
                         class="text-secondary w-4 h-4 hover:text-red-500"/>
        </div>
      </div>
    @endforeach
  </div>
</div>

