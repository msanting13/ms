<?php

namespace App\Http\Controllers;

use App\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function researchSubmittedReportData()
    {
        return Datatables::of(Reportable::query())->setTransformer(new \App\Transformers\ReportableTransformer)->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $card = Card::create($request->all());
        if ($card) 
        {
            alert()->success($request->name, 'Successfully created!')->persistent('Ok');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        return view('admin.research-boards-cards', compact('card'));
    }

    public function showExtension(Card $card)
    {
        return view('admin.extension-boards-cards', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        return view('admin.crud-form.edit-card', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        $card->fiscal_year = $request->fiscal_year;
        $card->card_name = $request->card_name;
        $card->description = $request->description;
        $card->save();

        alert()->success('Successfully updated!')->persistent('Ok');
        return redirect()->back();
    }

    public function editMessage(Card $card)
    {
        return view('admin.crud-form.edit-message', compact('card'));
    }

    public function updateMessage(Request $request, Card $card)
    {
        $card->message = $request->message;
        $card->save();

        alert()->success($request->name, 'Successfully updated!')->persistent('Ok');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $card->delete();
        alert()->success('Successfully deleted!')->persistent('Ok');
        return redirect()->back();
    }
    public function lock(Card $card)
    {
        $card->is_lock = 1;
        $card->save();
        alert()->success($card->title, 'locked!')->persistent('Ok');
        return back();
    }    
    public function unlock(Card $card)
    {
        $card->is_lock = 0;
        $card->save();
        alert()->success($card->title, 'Unlocked!')->persistent('Ok');
        return back();
    }
}
