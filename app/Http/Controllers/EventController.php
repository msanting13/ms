<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use App\Traits\PublisherTrait;
use Alert;

class EventController extends Controller
{
    use PublisherTrait;

    public function eventsData()
    {
        return datatables()->of(Event::query())
            ->addColumn('date', function ($date) {
                return (!$date->is_allDay) ? date('F d, Y h:i A', strtotime($date->start_date.$date->start_time)).' To '.date('F d, Y h:i A', strtotime($date->end_date.$date->end_time)): 'All day' ;
            })   
            ->addColumn('action', function ($event) {
                return view('admin.crud-form.crud-btn.event-btn', compact('event'));
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
        return view('admin.manage-events');
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
        Event::create([
            'event_name'    =>      $request->name,
            'location'      =>      $request->location,
            'start_date'    =>      date("Y-m-d",strtotime($request->startdate)),
            'start_time'    =>      (!is_null($request->starttime)) ? date("H:i:s",strtotime($request->starttime)) : NULL,
            'end_date'      =>      date("Y-m-d",strtotime($request->enddate)),
            'end_time'      =>      (!is_null($request->endtime)) ? date("H:i:s",strtotime($request->endtime)) : NULL,
            'description'   =>      $request->description,
            'is_allDay'        =>   ($request->allday == 'true') ? 1 : 0
        ]);

        alert()->success($request->name, 'Successfully Saved!')->persistent('Ok');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.crud-form.edit-event', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $event->event_name = $request->name;
        $event->location =  $request->location;
        $event->start_date = date("Y-m-d",strtotime($request->startdate));
        $event->start_time = (!is_null($request->starttime)) ? date("H:i:s",strtotime($request->starttime)) : NULL;
        $event->end_date = date("Y-m-d",strtotime($request->enddate));
        $event->end_time = (!is_null($request->endtime)) ? date("H:i:s",strtotime($request->endtime)) : NULL;
        $event->description = $request->description;
        $event->is_allDay = ($request->allday == 'true') ? 1 : 0;
        $event->save();

        alert()->success('Successfully Updated!')->persistent('Ok');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        alert()->success('Successfully Deleted!')->persistent('Ok');
        return back();
    }
    public function publish(Event $event)
    {
       return $this->publisher($event);
    }
}
