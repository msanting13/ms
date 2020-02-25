<?php

namespace App\Http\Controllers;

use App\ExtensionReportPhoto;
use App\ExtensionReport;
use Illuminate\Http\Request;

class ExtensionReportPhotoController extends Controller
{
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
    public function update(Request $request, ExtensionReportPhoto $extensionReportPhoto,$id)
    {
        $extensionReport = ExtensionReport::find($id);
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
        alert()->success('Successfully updated!')->persistent('Ok');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExtensionReportPhoto  $extensionReportPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExtensionReportPhoto $extensionReportPhoto)
    {
        //
    }
}
