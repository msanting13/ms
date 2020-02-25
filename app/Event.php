<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['event_name','location','description','start_date','start_time','end_date','end_time','is_allDay','is_published'];
    protected $casts = [
        'is_published'    =>  'boolean',
        'is_allday'    	  =>  'boolean'
    ];
}
