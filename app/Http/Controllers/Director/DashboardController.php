<?php

namespace App\Http\Controllers\Director;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
    	return view('director.director-dashboards');
    }
}
