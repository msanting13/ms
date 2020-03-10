<?php

namespace App\Http\Controllers;

use App\Card;
use App\User;
use App\ResearchReport;
use Illuminate\Support\HtmlString;
use Illuminate\Http\Request;

class GenerateResearchReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $campuses = User::getDefaultCampuses();
        // $fundingSources = ResearchReport::select('funding_source')->distinct('funding_source')->get();
        // $fundingAgencies = ResearchReport::select('agency')->distinct('agency')->get();

        return view('generate-reports.research.index');
    }
    
    public function indexData()
    {
        return datatables()->of(Card::query()->where('type','research')->where('is_published', true))
        ->addColumn('deadline', function($card){
            return $card->deadline->format('F d,Y');
        })
        ->addColumn('status', function ($card) {
            return new HtmlString(($card->is_lock) ? '<i class="fas fa-lock" style="color: #e74a3b;"></i>' : '<i class="fas fa-unlock" style="color: #36b9cc;"></i>');
        })->addColumn('action', function ($card) {
            return view('generate-reports.research.buttons.view-btn', compact('card'));
        })->make(true);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $card = Card::find($id);
        return view('generate-reports.research.show', compact('card'));
    }
    
    public function showData($id)
    {
        return datatables()->of(ResearchReport::query()->where('card_id',$id)->where('is_published', true)->get())
        ->addColumn('submitted_by', function ($by) {
            return $by->users->name;
        })
        ->addColumn('campus', function ($campus) {
            return $campus->users->campuses;
        })
        ->addColumn('file_url', function ($file) {
            return new HtmlString("<a href='".$file->url."'>".$file->file."</a>");
        })
        ->make(true); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
