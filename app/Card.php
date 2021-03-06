<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['card_name','description','message','fiscal_year','type','is_lock','is_published','deadline'];
    protected $dates = ['deadline'];
    protected $casts = [
        'is_lock'    =>  'boolean',
        'is_published'    =>  'boolean'
    ];

    public function researchReports()
    {
    	return $this->hasMany('App\ResearchReport','card_id');
    }
    public function extensionReports()
    {
    	return $this->hasMany('App\ExtensionReport','card_id');
    }
}
