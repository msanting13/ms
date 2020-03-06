<?php

namespace App\Http\Controllers\Admin;

use App\ResearchReport;
use App\Card;
use Auth;
use Illuminate\Support\HtmlString;
// use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResearchReportsController extends Controller
{
    public function __construct()
    {
        $this->file_path = public_path('/public_files/');
    }
    public function researchReportsData($id)
    {
        return datatables()->of(ResearchReport::where('card_id',$id)->get())->setTransformer(new \App\Transformers\ResearchReportTransformer)->make(true);  
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
        return view('users.user-submit-research-report', compact('cardID'));
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

        $file = $request->file('file');

        if (!is_dir($this->file_path)) 
        {
            mkdir($this->file_path, 0777);
        }

        $new_name = rand(). '.' . $file->getClientOriginalExtension();
        $is_move = $file->move($this->file_path, $new_name);
        if ($is_move) 
        {
            $card->researchReports()->create([
                'title'                         =>          $request->title,
                'short_description'             =>          $request->short_description,
                'project_cost'                  =>          $request->project_cost,
                'funding_source'                =>          $request->funding_source,
                'agency'                        =>          $request->agency,
                'sdgs_addressed'                =>          $request->sdgs_addressed,
                'beneficiaries'                 =>          $request->beneficiaries,
                'file'                          =>          $new_name,
                'user_id'                       =>          Auth::id()
            ]);
            alert()->success('Successfully submitted!')->persistent('Ok');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchReport  $research_report
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchReport $research_report)
    {
        return view('reports-details.research-reports-details', compact('research_report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchReport  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchReport $research_report)
    {
        return view('users.user-edit-research-report', compact('research_report'));
    }
    public function editReportFile(ResearchReport $research_report)
    {
        return view('users.user-edit-report-file', compact('research_report'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchReport  $research_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchReport $research_report)
    {
        $research_report->update($request->all());
        alert()->success('Successfully updated!')->persistent('Ok');
        return redirect()->back();
    }
    public function updateReportFile(Request $request, ResearchReport $research_report)
    {
        $file = $request->file('file');
        $new_name = rand(). '.' . $file->getClientOriginalExtension();
        $is_move = $file->move($this->file_path, $new_name);

        if ($is_move) 
        {
            $research_report->file = $new_name;
            $research_report->save();
        }
        alert()->success('Successfully changed!')->persistent('Ok');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchReport  $research_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchReport $research_report)
    {
        //
    }
}
