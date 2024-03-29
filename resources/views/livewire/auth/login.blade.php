<section class="flex justify-between h-screen">

  <section class="flex flex-col w-full gap-40 p-6
                  xs:w-[420px]
                  md:w-5/12 md:p-[40px]
                  lg:w-5/12 lg:p-[70px] lg:gap-0 lg:justify-between
                  xl:w-4/12">
    <x-logo/>

    <div class="flex flex-col gap-5  md:gap-8">
      <h2 class="font-bold text-2xl  md:text-3xl  lg:text-4xl">Login</h2>

      @if(!$linkSent && !$errors->has('email'))
        <p class="text-sm text-secondary">Enter your email address and we will email you a magic link to login.</p>

        <form wire:submit="sendMagicLink" class="flex flex-col gap-5">
          <x-forms.input wire:model="email" type="email" label="Email" required/>
          <x-forms.button wire:target="sendMagicLink" type="submit" text="Send login link"/>
        </form>

        @error('throttle')
        <div class="w-3/2">
          <p class="text-sm text-error">{{ $message }}</p>
        </div>
        @enderror
      @elseif($linkSent)
        <div class="flex flex-col gap-6">
          <h3 class="text-2xl font-bold">Hello, {{ $user->first_name }}!</h3>
          <p class="text-sm text-secondary">
            A magic link has been sent to your email address
            <span class="text-accent font-bold">{{ $user->email }}</span>.
          </p>
          <p class="text-sm text-secondary">
            Click on the link in the email and you will be automatically taken to your account.
          </p>
        </div>
      @endif

      @if($errors->has('email'))
        <div class="flex flex-col gap-6">
          <p class="text-sm text-error">We cannot find anyone registered under the email
            <span class="font-bold">{{ $email }}</span>.
          </p>
          <p class="text-sm text-secondary">
            Please check for typos and click back to try again. If there is a problem please email sys@ablou.co.uk.
          </p>
        </div>
        <x-forms.button wire:click="back" text="Back" :icon="svg('heroicon-s-chevron-left', 'w-4 h-4')"
                        :is-secondary="true"/>
      @endif

      @if($errors->has('url'))
        <div class="flex flex-col gap-6">
          <p class="text-sm text-error">
            The link you are trying to use is invalid or has expired. Please request a new link.
          </p>
        </div>
      @endif

    </div>

    <!-- Following empty div is mandatory for alignment -->
    <div></div>
  </section>

  <section class="hidden p-4  md:block md:w-6/12  lg:w-6/12 xl:w-7/12">
    <img class="h-full w-full" src="{{ Vite::image('login-background.png') }}" alt="banner">
  </section>

</section>
