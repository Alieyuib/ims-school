<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //

    protected $table = 'galleries';
    protected $fillable = [
        'caption_img',
        'img_file',
    ];
}
