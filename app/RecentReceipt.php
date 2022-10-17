<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecentReceipt extends Model
{
    //
    protected $table = 'recent_receipts';
    protected $fillable = [
        'receipt_id',
        'receipt',
        'student_email',
    ];

}
