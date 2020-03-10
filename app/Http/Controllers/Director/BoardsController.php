<?php

namespace App\Http\Controllers\Director;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Card;
use Auth;
use Illuminate\Support\HtmlString;

class BoardsController extends Controller
{
    public function getResearch()
    {
        return view('directors.director-research');
    }

    public function getExtension()
    {
        return view('directors.director-extension');
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
                $createRoute = "director-research-reports.create";
                $showRoute = "director-research-reports.index";
            }
            else{
                $createRoute = "director-extension-reports.create";
                $showRoute = "director-extension-reports.index";
            }
            return view('directors.crud-btn.submit-report-btn', compact('card','createRoute','showRoute'));
        })->make(true);  
    }

}
