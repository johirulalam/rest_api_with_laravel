@component('mail::message')
Dear {{$user->name}},

Thank you for creating an account.Please verify your acccount to click this button:

@component('mail::button', ['url' => route('verify', $user->verification_token)])
Verify account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
