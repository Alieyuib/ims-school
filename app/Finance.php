<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'finances';
    protected $fillable = [
        'ffname',
        'amount_to_pay',
        'amount_paid',
        'balance',
        'status',
        'invoice_no',
    ];
}
