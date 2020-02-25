<?php

namespace App\Http\Controllers;

use App\Announcement;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Alert;
use App\Traits\PublisherTrait;

class AnnouncementController extends Controller
{
    use PublisherTrait;
    
    public function announcementData()
    {
        return datatables()->of(Announcement::query())
            ->addColumn('action', function ($announcement) {
                return view('admin.crud-form.crud-btn.announcement-btn', compact('announcement'));
            })            
            ->addColumn('switch', function ($status) {
                $stat = $status->is_published;
                $id = $status->id;
                return  new HtmlString(view('admin.crud-form.switch-btn.switch-btn', compact('stat','id')));
            })->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage-announcement');
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
        Announcement::create([
            'title'         =>      $request->title,
            'overview'      =>      $request->overview,
            'content'       =>      $request->content
        ]);
        alert()->success($request->title, 'Successfully Saved!')->persistent('Ok');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        return view('admin.crud-form.edit-announcement', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        $announcement->title = $request->title;
        $announcement->overview = $request->overview;
        $announcement->content = $request->content;
        $announcement->save();
        alert()->success('Successfully Updated!')->persistent('Ok');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        alert()->success($announcement->title.' was deleted','Success')->persistent('Ok');
        return back();
    }
    public function publish(Announcement $announcement)
    {
       return $this->publisher($announcement);
    }
}
