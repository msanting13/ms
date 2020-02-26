<?php

namespace App\Http\Controllers;

use App\ExtensionReport;
use App\Card;
use Auth;
use App\ExtensionReportPhoto;
use Illuminate\Support\HtmlString;
// use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;

class ExtensionReportsController extends Controller
{
    public function __construct()
    {
        $this->file_path = public_path('/public_files/gallery');
    }

    public function extensionReportsData($id)
    {
        return datatables()->of(ExtensionReport::query()->where('card_id',$id))->setTransformer(new \App\Transformers\ExtensionReportTransformer)->make(true);  
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
    public function create(Request $request)
    {
        $cardID = Card::find($request->id)->id;
        return view('users.user-submit-extension-report',compact('cardID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $card = Card::find($request->cardid);

        $extensionReports =  $card->extensionReports()->create([
            'title'                         =>          $request->title,
            'short_description'             =>          $request->short_description,
            'project_cost'                  =>          $request->project_cost,
            'funding_source'                =>          $request->funding_source,
            'agency'                        =>          $request->agency,
            'sdgs_addressed'                =>          $request->sdgs_addressed,
            'beneficiaries'                 =>          $request->beneficiaries,
            'user_id'                       =>          Auth::id()
        ]);

        $photos = $request->file('file');

        for ($i=0; $i < count($photos); $i++) 
        { 
            $photo = $photos[$i];

            $new_name = rand(). '.' . $photo->getClientOriginalExtension();
            $is_move = $photo->move($this->file_path, $new_name);
            if ($is_move) {
                $extensionReports->extensionReportPhotos()->create([
                    'photo'                         =>          $new_name,
                ]);
            }

        }
        alert()->success('Successfully submitted!')->persistent('Ok');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExtensionReport  $extensionReport
     * @return \Illuminate\Http\Response
     */
    public function show(ExtensionReport $extensionReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExtensionReport  $extensionReport
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtensionReport $extensionReport)
    {
        return view('users.user-edit-extension-report', compact('extensionReport'));
    }    

    public function editReportPhoto(ExtensionReport $extensionReport)
    {
        return view('users.user-edit-extension-report-photos', compact('extensionReport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExtensionReport  $extensionReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExtensionReport $extensionReport)
    {
        $extensionReport->update($request->all());
        alert()->success('Successfully updated!')->persistent('Ok');
        return redirect()->back();
    }    
    public function addPhotos(Request $request, ExtensionReport $extensionReport)
    {

        $photos = $request->file('file');

        for ($i=0; $i < count($photos); $i++) 
        { 
            $photo = $photos[$i];

            $new_name = rand(). '.' . $photo->getClientOriginalExtension();
            $is_move = $photo->move($this->file_path, $new_name);
            if ($is_move) {
                $extensionReport->extensionReportPhotos()->create([
                    'photo'                         =>          $new_name,
                ]);
            }

        }
        alert()->success('Successfully added!')->persistent('Ok');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExtensionReport  $extensionReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExtensionReport $extensionReport)
    {
        $extensionReport->delete();
        alert()->success('Report deleted!')->persistent('Ok');
        return back();
    }
}
