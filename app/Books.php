<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'books';
    protected $fillable = [
        'book_name',
        'book_file',
    ];
}
