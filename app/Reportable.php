<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportable extends Model
{
	protected $table = 'reportable';
	protected $fillable = ['name','file','user_id'];

	public function reportable()
	{
		return $this->morphTo();
	}

	public function users()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
