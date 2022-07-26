<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
         /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teachers';
    protected $fillable = [
        'fname',
        'token',
        'teaching_subject',
        'email'
    ];
}
