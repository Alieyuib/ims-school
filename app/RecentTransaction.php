<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecentTransaction extends Model
{
    //
    protected $table = 'recent_transactions';
    protected $fillable = [
        'amount',
        'trans_id',
        'sid'
    ];
}
