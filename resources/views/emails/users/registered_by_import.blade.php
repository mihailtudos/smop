@component('mail::message')
    Greetings {{$user->name}},

    An account has been registered for you with the password: {{$password}}

    @component('mail::button', ['url' => route('login')])
        Login
    @endcomponent

    If you'd like you can reset your password
    @component('mail::button', ['url' => route('password.request')])
        Reset Password
    @endcomponent

    Thanks,
    {{ config('app.name') }}
@endcomponent
