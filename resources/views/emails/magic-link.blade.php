@component('mail::message')
  # Magic Link

  Please click the button below to login to your account.

  @component('mail::button', ['url' => $url])
    Click to Login
  @endcomponent

  Thanks,<br>
  {{ config('app.name') }}

  If you have any trouble clicking the "Click to Login" button, copy and paste the following URL into your browser: [{{ $url }}]({{ $url }})
@endcomponent
