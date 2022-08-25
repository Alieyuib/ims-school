<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = [
        'to_who',
        'address',
        'email',
        'phone_no',
        'status',
        'total'
    ];
}
