<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'number',
        'benum',
        'city',
        'price',
        'pick',
        'user',
    ];
    protected $table = 'posts';
}
