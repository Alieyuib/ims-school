<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $table = 'student_class';
    protected $fillable = [
        'class_name',
    ];
}
