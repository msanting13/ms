<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtensionReportPhoto extends Model
{
	protected $fillable = ['extension_report_id','photo','url'];

	public function extensionReports()
	{
		return $this->belongsTo('App\ExtensionReport','extension_report_id');
	}
}
