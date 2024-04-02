@props(['id', 'text', 'active'])

<button wire:click="{{ $id }}"
        class="text-secondary text-xs sm:text-sm font-medium
               border border-neutral-content focus-visible:border-secondary focus:outline-none
               rounded-lg h-[42px] px-7 {{ $active == $id ? 'bg-base-200 border-transparent' : 'bg-white' }}">
  <x-uiw-loading wire:loading wire:target="{{ $id }}" class="animate-spin w-3 h-3 mr-1"/>
  {{ $text }}
</button>
