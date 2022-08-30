<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemCheckout extends Model
{
    //
    protected $table = 'item_checkouts';
    protected $fillable = [
        'student_id',
        'item_name',
        'item_price',
        'quantity',
        'total',
        'order_id',
        'discount'
    ];
}
