<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentFamilyAccount extends Model
{
    //
    protected $table = 'student_family_accounts';
    protected $fillable = [
        'account_name',
        'phone_no',
        'email',
        'balance',
    ];
}
