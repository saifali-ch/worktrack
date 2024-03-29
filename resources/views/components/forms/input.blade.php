@props(['label', 'type' => 'text', 'id' => str($label)->replace(' ', '_')->lower()])

<div class="form-control">
  <label for="{{ $id }}" class="text-secondary text-xs mb-1">
    {{ $label }}
  </label>
  <input
    {{ $attributes->merge(['class' => 'input input-bordered text-accent border-neutral-content w-full h-[42px] focus:outline-[1.5px]']) }}
    id="{{ $id }}" type="{{ $type }}" {{ $attributes }}>
  @error((string) $id)<span class="text-xs text-error mt-1">{{ $message }}</span>@enderror
</div>
