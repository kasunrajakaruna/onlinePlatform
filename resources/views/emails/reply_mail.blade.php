@component('mail::message')

    E Support Agent Replyed to your ticket Ref. no {{ $refenrence_no }}<br>
    "<b>{{ $reply }}</b>"

    Thanks,
    {{ config('app.name') }}
@endcomponent
