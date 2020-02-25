<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
   protected $fillable = ['title','overview','content','is_published'];
   protected $casts = [
   	'is_published'    =>  'boolean'
   ];
}
