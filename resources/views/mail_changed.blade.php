@component('mail::message')
Dear {{$user->name}},

You request for changing your mail.Please click this button for  verify :

@component('mail::button', ['url' => route('verify', $user->verification_token)])
Verify account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
