<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecentInvoice extends Model
{
    //
    protected $table = 'recent_invoices';
    protected $fillable = [
        'invoice_id',
        'invoice',
        'student_email',
    ];
}

