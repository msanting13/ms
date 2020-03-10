<?php

namespace App\Http\Controllers\Director;
use Auth;
use App\Card;
use Illuminate\Support\HtmlString;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageReportsController extends Controller
{
	public function __construct()
	{
		$this->middleware('adminpassword',['only' => ['lockAndUnlock']]);
	}
	public function index()
	{
		return view('directors.manage-report-form.report-forms');
	}
	public function reportForms()
	{
        return datatables()->of(Card::query()->where(function ($query){
            if (!Auth::user()->hasRole('role_admin')) {
                $query->where('is_published', TRUE);
            }
        }))
        ->addColumn('type', function ($card){
        	return ucfirst($card->type);
        })
        ->addColumn('deadline', function($card){
        	return $card->deadline->format('F d,Y');
        })
        ->addColumn('status', function ($card) {
            return new HtmlString(($card->is_lock) ? '<i class="fas fa-lock locked" style="color: #d9534f;"></i>' : '<i class="fas fa-unlock unlock" style="color: #5cb85c;"></i>');
        })->addColumn('action', function ($card) {
        	return view('directors.crud-btn.lock-unlock-btn', compact('card'));
        })->make(true);  
	}

	public function lockAndUnlock($id)
	{
		$card = Card::find($id);
		if (!$card->is_lock) {
			$card->is_lock = true;
			$message = 'locked';
		}else{
			$card->is_lock = false;
			$message = 'unlock';
		}
		$card->save();
		return response()->json(['done' => TRUE, 'message' => $message]);
	}
}
