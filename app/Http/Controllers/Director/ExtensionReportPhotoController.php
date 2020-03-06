<?php

namespace App\Http\Controllers\Director;

use App\ExtensionReportPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;

class ExtensionReportPhotoController extends Controller
{
    public function __construct() {
        $this->middleware('adminpassword',['only' => ['destroy']]);

        $this->photo_path = public_path('/public_files/gallery/');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExtensionReportPhoto  $extensionReportPhoto
     * @return \Illuminate\Http\Response
     */
    public function show(ExtensionReportPhoto $extensionReportPhoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExtensionReportPhoto  $extensionReportPhoto
     * @return \Illuminate\Http\Response
     */
    public function edit(ExtensionReportPhoto $extensionReportPhoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExtensionReportPhoto  $extensionReportPhoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExtensionReportPhoto $extensionReportPhoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExtensionReportPhoto  $user_extension_reports_photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExtensionReportPhoto $director_extension_reports_photo)
    {
        File::delete($this->photo_path.$director_extension_reports_photo->photo);
        $director_extension_reports_photo->delete();
        return response()->json(['success' => true, 'message' => 'Successfully deleted!']);
    }
}
