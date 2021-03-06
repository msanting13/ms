<?php

namespace App\Http\Controllers\Admin;

use App\Card;
use Carbon\Carbon;
use Alert;
use App\Traits\PublisherTrait;
use App\Http\Requests\CardRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    use PublisherTrait;

    public function __construct()
    {
        $this->middleware('adminpassword',['only' => ['destroy','publish']]);
    }

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
        return view('admin.create-card');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CardRequest $request)
    {
        $card = Card::create([
            'type'                  =>      $request->type,
            'fiscal_year'           =>      $request->fiscal_year,
            'card_name'             =>      $request->card_name,
            'description'           =>      $request->description,
            'message'               =>      $request->message,
            'deadline'              =>      Carbon::parse($request->deadline),
        ]);

        if ($card) 
        {
            if ($request->type == "research") {

                alert()->success($request->name, 'Successfully created!')->persistent('Ok');
                return redirect()->route('admin-research.index');

            }
            if ($request->type == "extension") {

                alert()->success($request->name, 'Successfully created!')->persistent('Ok');
                return redirect()->route('admin-extension.index');

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Card  $admin_research_card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $admin_research_card)
    {
        $card = $admin_research_card;
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
        $this->validate(request(),[
            'card_name' =>  ['required', Rule::unique('cards')->where(function ($query) use ($request,$card){
                                return $query->where('fiscal_year', $request->fiscal_year)->where('type', $card->type);
            })->ignore($card->id)],
        ],[
            'type.required'          =>  'Report for field is required.',
            'card_name.unique'      =>  'Report is already exist.',
        ]);
        
        $card->fiscal_year = $request->fiscal_year;
        $card->card_name = $request->card_name;
        $card->description = $request->description;
        $card->message = $request->message;
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
        return response()->json(['success' => true, 'message' => 'Successfully deleted!']);
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

    public function publish(Card $card)
    {
       return $this->publisher($card);
    }
}
