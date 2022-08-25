<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class systemUsers extends Model
{
    protected $table = 'system_users';
    protected $fillable = [
        'fname',
        'phone_no',
        'email',
        'password',
        'role',
    ];
}
