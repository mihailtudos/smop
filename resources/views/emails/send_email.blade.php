@component('mail::message')
You have received an email from {{$fromUser->name}}, reply to {{$fromUser->email}}.

Message body:<br>
{{$body}}


<p style="text-align: center; padding-top: 50px">Login to the application</p>
@component('mail::button', ['url' => route('login')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
