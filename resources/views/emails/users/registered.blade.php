@component('mail::message')
Greetings {{$user->name}},

An account has been registered for you:

Login email: {{$user->email}}
Password: {{$password}}

@component('mail::button', ['url' => route('login')])
Login
@endcomponent

It's safe to keep the given password, but if you wish you can change it by clicking on the below button!
@component('mail::button', ['url' => route('password.request')])
Reset Password
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
