@component('mail::message')
<h3 class="text-success"><b>Your Login Details {{ $to_who }}</b></h3>


@component('mail::panel')
<h4><b>Username:</b>&nbsp;{{ $email_to_send }}</h4>
<h4><b>Password:&nbsp;{{ $password }}</b></h4>

<h5 class="text-warning">
    <i>
        You can change your password after login.
        Administrator, The Priority School.
    </i>
</h5>
@endcomponent

{{-- {{ $pdf->output() }} --}}

@component('mail::button', ['url' =>'app.thepriorityschool.com/login', 'color' => 'success'])
Login
@endcomponent

Thanks,<br>
<i><b>{{ config('app.name') }}</b></i>
@endcomponent
