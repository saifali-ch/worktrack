@props(['text', 'icon' => '', 'class' => 'px-7', 'isSecondary' => false])

<button {{ $attributes->merge(['type' => $type ?? 'button']) }}
        class="{{ $isSecondary ? 'bg-white text-secondary
                                  focus:ring-transparent focus:border-secondary border border-neutral-content
                                  hover:bg-base-200'
                               : 'bg-primary text-white focus:ring-primary'
               }}
               inline-flex justify-center items-center gap-1
               text-xs font-medium rounded-lg h-[42px] {{ $class }}
               hover:bg-opacity-90
               focus:outline-none focus:ring-offset-2 focus:ring-[1.5px]
               disabled:opacity-75 disabled:cursor-not-allowed
               sm:text-sm">
  @if(!$isSecondary)
    <x-uiw-loading wire:loading {{ $attributes->thatStartWith('wire:target') }} class="animate-spin w-3 h-3 mr-1 hidden"/>
  @endif
  {{ $icon }} {{ $text }}
</button>
