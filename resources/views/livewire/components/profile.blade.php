<form wire:submit="save">
  <div class="flex flex-col gap-6 lg:pr-[120px]">
    <div x-data="{ uploading: false, progress: 0 }"
         x-on:livewire-upload-start="uploading = true"
         x-on:livewire-upload-finish="uploading = false; progress = 0"
         x-on:livewire-upload-progress="progress = $event.detail.progress">
      <div class="flex flex-col items-center relative  sm:flex-row">
        <input wire:model="uploaded_photo" type="file" x-ref="photoInput" class="hidden">

        @if ($uploaded_photo || $user->photo)
          <img src="{{ $uploaded_photo ? $uploaded_photo->temporaryUrl() : $user->photo }}"
               class="rounded-xl w-[120px] h-[120px] sm:w-[150px] sm:h-[150px] object-cover object-top"
               alt="">
          <div x-show="uploading"
               class="flex justify-center items-center text-white
                         absolute inset-0 bg-black bg-opacity-50 rounded-xl
                         w-[120px] h-[120px] sm:w-[150px] sm:h-[150px]">
            <span x-text="'Uploading ' + progress + '%'"></span>
          </div>
        @else
          <div @click="$refs.photoInput.click()"
               class="flex flex-col justify-center items-center
                            bg-background text-xs text-accent cursor-pointer
                            border-[1.5px] border-dashed border-secondary rounded-xl
                            w-[120px] h-[120px]  sm:w-[150px] sm:h-[150px] sm:text-sm">
            <div x-show="uploading">
              <span x-text="'Uploading ' + progress + '%'"></span>
            </div>
            <div x-show="!uploading" class="flex flex-col justify-center items-center">
              <x-heroicon-c-cloud-arrow-up class="w-5 h-5"/>
              <span>Upload photo</span>
            </div>
          </div>
        @endif

        <div class="flex flex-col items-center gap-2 text-xs text-neutral p-3  md:p-7">
          @if ($uploaded_photo || $user->photo)
            <x-forms.button @click="$refs.photoInput.click(); $event.target.blur()"
                            text="Change Photo"
                            :is-secondary="true"/>
          @endif
          JPG, GIF or PNG. Max size of 1024K
        </div>
      </div>
      @error('uploaded_photo') <span class="text-xs text-error mt-1">{{ $message }}</span> @enderror
    </div>

    <div class="flex flex-col gap-10 sm:flex-row">
      <div class="flex-1">
        <h2 class="text-sm text-accent font-medium mb-5">Personal Information</h2>
        <div class="flex flex-col gap-3">
          <x-forms.input wire:model="first_name" label="First Name"/>
          <x-forms.input wire:model="last_name" label="Last Name"/>
          <x-forms.input label="Email" type="email"
                         value="{{ auth()->user()->email }}" readonly/>

          @unless(auth()->user()->isAdmin())
            <x-forms.input wire:model="address" label="Address"/>
            <x-forms.input wire:model="post_code" label="Post Code"/>
          @endunless
        </div>
      </div>

      @unless(auth()->user()->isAdmin())
        <div class="flex-1">
          <h2 class="text-sm text-accent font-medium mb-5">Bank Details</h2>
          <div class="flex flex-col gap-3">
            <x-forms.input wire:model="account_name" label="Account Name"/>
            <x-forms.input wire:model="short_code" label="Short Code"/>
            <x-forms.input wire:model="account_number" label="Account Number"/>
          </div>
        </div>
      @endunless
    </div>
    @if($actions)
      <div class="flex gap-6 w-full  sm:w-1/2">
        <x-forms.button wire:target="save" text="Submit" type="submit"/>
        <x-forms.button wire:click="doItLater" text="I'll do it later" :is-secondary="true"/>
      </div>
    @endif
  </div>
</form>
