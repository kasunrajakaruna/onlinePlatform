@component('mail::message')

    Your Ticket has been created successfully.
    <br>
    your reference number is <b>{{ $refenrence_no }}</b>

    Thanks,
    {{ config('app.name') }}
@endcomponent
