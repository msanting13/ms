<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResearchReport extends Model
{
	protected $fillable = ['title','short_description','project_cost','funding_source','agency','sdgs_addressed','beneficiaries','file','url','user_id'];
    protected $casts = [
        'is_published'    =>  'boolean'
    ];
	public function cards()
	{
		return $this->belongsTo('App\Card','card_id');
	}
	
	public function users()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
