<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtensionReport extends Model
{
	protected $fillable = ['title','short_description','project_cost','funding_source','agency','sdgs_addressed','beneficiaries','user_id'];

	public function cards()
	{
		return $this->belongsTo('App\Card','card_id');
	}
	
	public function users()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function extensionReportPhotos()
	{
		return $this->hasMany('App\ExtensionReportPhoto','extension_report_id');
	}
}
