@component('mail::message')
Hello and welcome to Navo! <br><br>
You have been added to a team! This will give you full access to our oil well locator at no cost.<br><br>
All you have to do is activate your account: <br>

@component('mail::button', ['url' => route('activation.activate.team', $token)])
    Activate Your Account
@endcomponent

Your Password is: @php echo($password) @endphp <br>
You will be asked to change this once you activate your account.<br>

Thank you,<br>
Tony<br>
@php echo('<a href="mailto:tony@navoapp.io">tony@navoapp.io</a>') @endphp <br>

PS: If you find this to be an error. Please let me know.
@endcomponent