<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentData extends Model
{
       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student_data';
    protected $fillable = [
        'name',
        'dob',
        'sickness_allergy',
        'address',
        'phone_no',
        'email',
        'date_admitted',
        'class_admitted',
        'current_class',
        'passport',
        'token',
        'guardian',
        'status',
        'name_of_school',
        'ffname',
        'Subject_learned',
        'pob',
        'balance'
    ];
}
