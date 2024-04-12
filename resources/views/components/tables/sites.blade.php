<div>
  <div class="overflow-y-scroll {{ $class }}" tabindex="-1">
    <table class="table sm:table-sm  md:table-md">
      <thead class="sticky top-0">
      <tr class="text-xs text-secondary select-none border-0">
        <td class="text-xs text-secondary font-normal bg-base-200 rounded-l-xl w-[50%]  md:w-[70%]">Site Name</td>
        <td class="text-xs text-secondary font-normal bg-base-200">Creation Date</td>
        <td class="bg-base-200 rounded-r-xl"></td>
      </tr>
      </thead>
      <tbody>
      @foreach($sites as $site)
        <tr class="cursor-default hover:bg-base-200">
          <td class="text-sm text-accent w-[50%]  md:w-[70%]">{{ $site->name }}</td>
          <td class="text-sm text-secondary">{{ $site->created_at->format('F d, Y') }}</td>
          <td>
            <div class="flex justify-end gap-2 sm:gap-6 cursor-pointer">
              <x-icon-writing wire:click="dispatch('showModal', ['edit-site', {{ $site->id }}])"
                              class="text-secondary w-4 h-4 hover:text-blue-500"/>

              <x-icon-delete wire:click="dispatch('showModal', ['delete-site', {{ $site->id }}])"
                             class="text-secondary w-4 h-4 hover:text-red-500"/>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

