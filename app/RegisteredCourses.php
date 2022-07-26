<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisteredCourses extends Model
{
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'registered_courses';
    protected $fillable = [
        'student_id',
        'student_name',
        'student_class',
        'academic_term',
        'academic_session',
        'sub_one',
        'sub_two',
        'sub_three',
        'sub_four',
        'sub_one_scores',
        'sub_two_scores',
        'sub_three_scores',
        'sub_four_scores',
    ];
}
