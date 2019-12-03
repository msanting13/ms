<?php

namespace App\Http\Controllers;

use App\ResearchCard;
use Auth;
use Illuminate\Http\Request;

class ResearchCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
 
        Auth::user()->researchCards()->create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchCard  $researchCard
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchCard $researchCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchCard  $researchCard
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchCard $researchCard,$id)
    {
        $researchCard = ResearchCard::find($id);
        return view('admin.crud-form.edit-card', compact('researchCard','id'));
    }

    public function editMessage($id)
    {
        $message = ResearchCard::find($id);
        return view('admin.crud-form.edit-message', compact('message','id'));
    }

    public function updateMessage(Request $request, $id)
    {
        $message = ResearchCard::find($id);
        $message->message = $request->message;
        $message->save();

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchCard  $researchCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchCard $researchCard, $id)
    {
        $researchCard = ResearchCard::find($id);
        $researchCard->fiscal_year = $request->fiscal_year;
        $researchCard->card_name = $request->card_name;
        $researchCard->description = $request->description;
        $researchCard->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchCard  $researchCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchCard $researchCard, $id)
    {
        $researchCard = ResearchCard::find($id);
        $researchCard->delete();
        return redirect()->back();
    }
}
