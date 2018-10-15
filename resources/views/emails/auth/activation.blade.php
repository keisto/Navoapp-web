@component('mail::message')
Hello and welcome to Navo! <br><br>
Please activate your account:

@component('mail::button', ['url' => route('activation.activate', $token)])
Activate Your Account
@endcomponent

Thank you,<br>
Tony<br>
tony@navoapp.io
@endcomponent
