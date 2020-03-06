<?php

namespace App\Http\Controllers\Director;

use App\ExtensionReport;
use App\Card;
use Auth;
use File;
use App\Traits\PdfTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JD\Cloudder\Facades\Cloudder;

class ExtensionReportsController extends Controller
{
    use PdfTraits;
    
    public function __construct()
    {
        $this->middleware('adminpassword',['only' => ['destroy','postReport']]);
        $this->middleware('checkiflocked', ['only'=>['create']]);

        $this->photo_path = public_path('/public_files/gallery/');
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
        return view('directors.director-extension-report', compact('card'));
    }

    public function directorExtensionReportData($cardId, $type)
    {
        return datatables()->of(ExtensionReport::query()->where('card_id',$cardId)->where('user_id', Auth::id()))
        ->addColumn('action', function ($report){
            return view('directors.crud-btn.extension-report-btn', compact('report'));
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
        return view('directors.director-submit-extension-report', compact('card'));
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
            'title'             =>      ['required','unique:extension_reports'],
        ]);


        $card = Card::find($request->cardid);


        if ($request->hasFile('file')) {

            $uploadedFile = $this->uploadAttachFile($request->title, $request->file('file'));

            $extensionReports = $card->extensionReports()->create([
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

        if ($request->hasFile('photos')) {

            $this->uploadPhotos($extensionReports, $request->title, $request->file('photos'));

        }

        alert()->success('Successfully submitted!')->persistent('Ok');
        return redirect()->route('director-extension-reports.index',$card->id);

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

    function uploadPhotos($extensionReports, $title, array $photos)
    {
        if (!is_dir($this->photo_path)) 
        {
            mkdir($this->photo_path, 0777);
        }

        \Cloudinary::config(array( 
            'cloud_name' => config('cloudinary.CLOUD_NAME'), 
            'api_key'    => config('cloudinary.API_KEY'), 
            'api_secret' => config('cloudinary.API_SECRET'), 
            'secure'     => true
        ));

        for ($i=0; $i < count($photos); $i++) 
        {
            $photo = $photos[$i];
            $new_name = $title.'_'.Auth::user()->campuses.'_'.$photo->getClientOriginalName();

            $destination =  $this->photo_path.str_replace(' ', '_', $new_name);
            move_uploaded_file($photo, $destination);
        
            $uploaded = \Cloudinary\Uploader::upload($destination, [
                'use_filename'    => true,
                'unique_filename' => false,
                'resource_type'   => 'auto'
            ]);
            
            $extensionReports->extensionReportPhotos()->create([
                'photo'     =>       str_replace(' ', '_', $new_name),
                'url'       =>       $uploaded['url']
            ]);


        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExtensionReport  $director_extension_report
     * @return \Illuminate\Http\Response
     */
    public function show(ExtensionReport $director_extension_report)
    {
        return view('directors.director-show-extension-report', compact('director_extension_report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExtensionReport  $director_extension_report
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtensionReport $director_extension_report)
    {
        return view('directors.director-edit-extension-report', compact('director_extension_report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExtensionReport  $director_extension_report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExtensionReport $director_extension_report)
    {
        if ($request->hasFile('file')) {

            $uploadedFile = $this->uploadAttachFile($director_extension_report->title, $request->file('file'));

            $director_extension_report->file = $uploadedFile['new_name'];
            $director_extension_report->url = $uploadedFile['url'];
            $director_extension_report->save();

        }elseif ($request->hasFile('photos')) {

            $this->uploadPhotos($director_extension_report, $director_extension_report->title, $request->file('photos'));


        }else{
            $director_extension_report->update($request->all());
        }

        alert()->success('Successfully updated!')->persistent('Ok');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExtensionReport  $director_extension_report
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExtensionReport $director_extension_report)
    {
        $director_extension_report->extensionReportPhotos()->delete();
        $director_extension_report->delete();
  
        return response()->json(['success' => true, 'message' => 'Successfully deleted!']);
    }

    public function postReport(ExtensionReport $director_extension_report)
    {
        $director_extension_report->is_published = true;
        $director_extension_report->save();
        return response()->json(['success' => true, 'message' => 'Successfully posted!']);
    }

    public function exportReportDetailspdf($id)
    {
        $reports = ExtensionReport::find(decrypt($id));
        $view = 'print-reports.directors.submitted-extension-reports-details';
        $data = $reports;
        return $this->exportToPdf($view,$data);
    }
    
    public function exportReportspdf($id)
    {
        $reports = ResearchReport::where('card_id',decrypt($id))->where('user_id', Auth::id())->get();
        $view = 'print-reports.directors.submitted-extension-reports';
        $data = $reports;
        return $this->exportToPdf($view,$data);
    }
    
}
