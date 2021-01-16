<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'number',
        'benum',
        'city',
        'pick',
        'user',
    ];
    protected $table = 'posts';
}
