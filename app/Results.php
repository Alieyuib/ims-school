<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    protected $table = 'results';
    protected $fillable = [
        'student_id',
        'academic_session',
        'academic_term',
        'quran',
        'azkar',
        'huruf',
        'arabiyya',
        'class_in',
        'no_in_class'
    ];
}
