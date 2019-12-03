<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
	protected $table = 'research_boards';
	protected $fillable = ['board_name','description'];

}
