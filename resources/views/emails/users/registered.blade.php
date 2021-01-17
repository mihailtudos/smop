@component('mail::message')
Greetings {{$user->name}},

An account has been registered for you:

Login email: {{$user->email}}
Password: {{$password}}

@component('mail::button', ['url' => 'http://127.0.0.1:8000/login'])
Login
@endcomponent

It's safe to keep the given password. However, you can change it by clicking the below button.
@component('mail::button', ['url' => 'http://127.0.0.1:8000/password/reset'])
Reset Password
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
