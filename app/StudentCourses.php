<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourses extends Model
{
    protected $table = 'student_courses';
    protected $fillable = [
        'student_id',
        'course_name',
        'course_id',
    ];
}
