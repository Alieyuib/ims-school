<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    //
    protected $table = 'expenses';
    protected $fillable = [
        'expenses_name',
        'expenses_price',
        'expenses_status'
    ];
}
