<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    //
    protected $table = 'items';
    protected $fillable = [
        'item_name',
        'item_price',
        'type'
    ];
}
