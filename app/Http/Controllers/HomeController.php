<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Announcement;
use App\Event;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news = News::where('is_published', true)->limit(5)->get();
        $announcements = Announcement::where('is_published', true)->limit(5)->get();
        $events = Event::where('is_published', true)->limit(5)->get();
        return view('home', compact('news','announcements','events'));
    }

    public function viewNewsDetails(News $news)
    {
        $otherNews = News::where('is_published', true)->get();
        return view('post-details.news-details', compact('otherNews','news'));
    }

    public function viewAnnouncementDetails(Announcement $announcement)
    {
        $otherAnnouncements = Announcement::where('is_published', true)->get();
        return view('post-details.announcement-details', compact('otherAnnouncements','announcement'));
    }

    public function viewEventDetails(Event $event)
    {
        $otherEvents = Event::where('is_published', true)->get();
        return view('post-details.event-details', compact('otherEvents','event'));
    }
}
