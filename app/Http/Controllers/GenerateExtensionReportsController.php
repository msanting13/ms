<?php

namespace App\Http\Controllers;

use App\Card;
use App\User;
use App\ExtensionReport;
use Illuminate\Support\HtmlString;
use Illuminate\Http\Request;

class GenerateExtensionReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('generate-reports.extension.index');
    }

    public function indexData()
    {
        return datatables()->of(Card::query()->where('type','extension')->where('is_published', true))
        ->addColumn('deadline', function($card){
            return $card->deadline->format('F d,Y');
        })
        ->addColumn('status', function ($card) {
            return new HtmlString(($card->is_lock) ? '<i class="fas fa-lock" style="color: #e74a3b;"></i>' : '<i class="fas fa-unlock" style="color: #36b9cc;"></i>');
        })->addColumn('action', function ($card) {
            return view('generate-reports.extension.buttons.view-btn', compact('card'));
        })->make(true);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return view('generate-reports.extension.show', compact('card'));
    }

    public function showData($id)
    {
        return datatables()->of(ExtensionReport::query()->where('card_id',$id)->where('is_published', true)->get())
        ->addColumn('submitted_by', function ($by) {
            return $by->users->name;
        })
        ->addColumn('campus', function ($campus) {
            return $campus->users->campuses;
        })
        ->addColumn('photos', function ($photos) {
            return new HtmlString(view('generate-reports.extension.photos.photos', compact('photos'))->render());
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
