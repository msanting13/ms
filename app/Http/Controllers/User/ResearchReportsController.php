<?php

namespace App\Http\Controllers\User;

use App\ResearchReport;
use App\Traits\PdfTraits;
use App\Card;
use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResearchReportsController extends Controller
{
    use PdfTraits;
    
    public function __construct()
    {
        $this->middleware('adminpassword',['only' => ['destroy','postReport']]);
        $this->middleware('checkiflocked', ['only'=>['create']]);

        $this->file_path = public_path('/public_files/');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $card = Card::find($id);
        return view('users.user-research-report', compact('card'));
    }

    public function userResearchReportData($cardId, $type)
    {
        return datatables()->of(ResearchReport::query()->where('card_id',$cardId)->where('user_id', Auth::id()))
        ->addColumn('action', function ($report){
            return view('users.crud-btn.research-report-btn', compact('report'));
        })
        ->make(true);  
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $card = Card::find($id); 
        return view('users.user-submit-research-report', compact('card'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'title'             =>      ['required','unique:research_reports'],
        ]);

        $card = Card::find($request->cardid);


        if ($request->hasFile('file')) {

            $uploadedFile = $this->uploadAttachFile($request->title, $request->file('file'));

            $card->researchReports()->create([
                'title'                         =>          $request->title,
                'short_description'             =>          $request->short_description,
                'project_cost'                  =>          $request->project_cost,
                'funding_source'                =>          $request->funding_source,
                'agency'                        =>          $request->agency,
                'sdgs_addressed'                =>          $request->sdgs_addressed,
                'beneficiaries'                 =>          $request->beneficiaries,
                'file'                          =>          str_replace(' ', '_', $uploadedFile['new_name']),
                'url'                           =>          $uploadedFile['url'],
                'user_id'                       =>          Auth::id()
            ]);
    

        }
        alert()->success('Successfully submitted!')->persistent('Ok');
        return redirect()->route('user-research-reports.index',$card->id);
    }

    public function uploadAttachFile($title, $file)
    {

        if (!is_dir($this->file_path)) 
        {
            mkdir($this->file_path, 0777);
        }

        \Cloudinary::config(array( 
            'cloud_name' => config('cloudinary.CLOUD_NAME'), 
            'api_key'    => config('cloudinary.API_KEY'), 
            'api_secret' => config('cloudinary.API_SECRET'), 
            'secure'     => true
        ));

        $new_name = $title.'_'.Auth::user()->campuses.'_'.$file->getClientOriginalName();

        $destination =  $this->file_path.str_replace(' ', '_', $new_name);
        move_uploaded_file($file, $destination);


        $uploaded = \Cloudinary\Uploader::upload($destination, [
            'use_filename'    => true,
            'unique_filename' => false,
            'resource_type'   => 'auto'
        ]); 

        return [
            'new_name'   =>     str_replace(' ', '_', $new_name), 
            'url'        =>     $uploaded['url']
        ];
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\ResearchReport  $user_research_report
     * @return \Illuminate\Http\Response
     */
    public function show(ResearchReport $user_research_report)
    {
        return view('users.user-show-research-report', compact('user_research_report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResearchReport  $user_research_report
     * @return \Illuminate\Http\Response
     */
    public function edit(ResearchReport $user_research_report)
    {
        return view('users.user-edit-research-report', compact('user_research_report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResearchReport  $user_research_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResearchReport $user_research_report)
    {
        if ($request->hasFile('file')) {

            $uploadedFile = $this->uploadAttachFile($user_research_report->title, $request->file('file'));

            $user_research_report->file = $uploadedFile['new_name'];
            $user_research_report->url = $uploadedFile['url'];
            $user_research_report->save();

        }else{
            $user_research_report->update($request->all());
        }

        alert()->success('Successfully updated!')->persistent('Ok');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResearchReport  $user_research_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResearchReport $user_research_report)
    {
        $user_research_report->delete();
        return response()->json(['success' => true, 'message' => 'Successfully deleted!']);
    }

    public function postReport(ResearchReport $user_research_report)
    {
        $user_research_report->is_published = true;
        $user_research_report->save();
        return response()->json(['success' => true, 'message' => 'Successfully posted!']);
    }
    public function exportReportDetailspdf($id)
    {
        $reports = ResearchReport::find(decrypt($id));
        $view = 'print-reports.users.submitted-research-reports-details';
        $data = $reports;
        return $this->exportToPdf($view,$data);
    }
    public function exportReportspdf($id)
    {
        $reports = ResearchReport::where('card_id',decrypt($id))->where('user_id', Auth::id())->get();
        $view = 'print-reports.users.submitted-research-reports';
        $data = $reports;
        return $this->exportToPdf($view,$data);
    }
}
