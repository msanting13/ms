<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchCard extends Model
{
    protected $fillable = ['card_name','description','message','fiscal_year'];

    public function users()
    {
    	return $this->belongsTo('App\User','user_id');
    }

    public function reports()
    {
    	return $this->morphMany('App\Reportable', 'reportable');
    }
}
