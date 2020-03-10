<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Card;
use Auth;
use Illuminate\Support\HtmlString;

class BoardsController extends Controller
{
    public function getResearch()
    {
        return view('users.user-research');
    }

    public function getExtension()
    {
        return view('users.user-extension');
    }

    public function reportsData($type)
    {
        // ->whereDoesntHave('researchReports', function ($query){
        //     $query->where('user_id', Auth::id());
        // })
        return datatables()->of(Card::query()->where('type',$type)->where('is_published', true))
        ->addColumn('deadline', function($card){
            return $card->deadline->format('F d,Y');
        })
        ->addColumn('status', function ($card) {
            return new HtmlString(($card->is_lock) ? '<i class="fas fa-lock" style="color: #e74a3b;"></i>' : '<i class="fas fa-unlock" style="color: #36b9cc;"></i>');
        })
        ->addColumn('action', function ($card) {
            if ($card->type == "research") {
                $createRoute = "user-research-reports.create";
                $showRoute = "user-research-reports.index";
            }
            else{
                $createRoute = "user-extension-reports.create";
                $showRoute = "user-extension-reports.index";
            }
            return view('users.crud-btn.submit-report-btn', compact('card','createRoute','showRoute'));
        })->make(true);  
    }

}
