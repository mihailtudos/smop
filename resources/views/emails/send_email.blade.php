@component('mail::message')
    You have received an email from {{$fromUser->name}}, reply to {{$fromUser->email}}.

    Message body:<br>
    {{$body}}

    Login to the application
    @component('mail::button', ['url' => route('login')])
        Login
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
