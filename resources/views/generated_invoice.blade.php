@component('mail::message')
Your New Invoice # {{ $invoice_no }}

The body of your message.

{{-- {{ $pdf->output() }} --}}

@component('mail::button', ['url' =>'/'])
View Invoice
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
