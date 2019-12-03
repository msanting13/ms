<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title','author','overview','content','cover_photos','is_published'];
    protected $casts = [
        'is_published'    =>  'boolean'
    ];
}
