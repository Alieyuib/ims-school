<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolClasses extends Model
{
    protected $table = 'school_classes';
    protected $fillable = [
        'class_name',
    ];
}
