<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAdults extends Model
{

        /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'students';
    protected $fillable = [
        'fname',
        'lname',
        'dob',
        'pob',
        'sickness_allergy',
        'guardian',
        'phone_no',
        'Subject_learned',
        'email',
        'name_of_school',
        'ffname',
        'address',
        'passport'
    ];
}
