<?php

namespace App\Http\Controllers;

use App\News;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\HtmlString;
use Alert;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->file_path = public_path('/public_files/image/news');
    }

    public function newsData()
    {
        return datatables()->of(News::select('id','title','author','is_published','cover_photos','created_at','updated_at'))
            ->addColumn('action', function ($news) {
                return view('admin.crud-form.crud-btn.news-btn', compact('news'));
            })            
            ->addColumn('switch', function ($status) {
                $stat = $status->is_published;
                $id = $status->id;
                return  new HtmlString(view('admin.crud-form.switch-btn.switch-btn', compact('stat','id')));
            })
            // ->addColumn('cover', function ($cover) {
            //     return new HtmlString(
            //         (!is_null($cover->cover_photos)) ? "<div class='row'><div class='col-md-3'><img src='/public_files/image/news/".$cover->cover_photos."'style='width: 320px; height: 213px;'></iv" : NULL
            //     );
            // })
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage-news');
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

        if (!is_dir($this->file_path)) 
        {
            mkdir($this->file_path, 0777);
        }
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $new_name = rand(). '.' . $file->getClientOriginalExtension();
            $file->move($this->file_path, $new_name);
        }

        News::create([
            'title'             =>      $request->title,
            'author'            =>      $request->author,
            'cover_photos'      =>      (isset($new_name)) ? $new_name : NULL,
            'overview'          =>      $request->overview,
            'content'           =>      $request->content
        ]);

        alert()->success($request->title, 'Successfully Saved!')->persistent('Ok');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('admin.crud-form.view-edit-newscover-photo',compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.crud-form.edit-news', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $news->title = $request->title;
        $news->author = $request->author;
        $news->overview = $request->overview;
        $news->content = $request->content;
        $news->save();
        alert()->success('Successfully Updated!')->persistent('Ok');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        $news->delete();
        alert()->success($news->title.' was deleted','Success')->persistent('Ok');
        return back();
    }

    public function uploadNewsCover(Request $request, News $news)
    {
        if ($request->hasFile('photo')) 
        {
            $file = $request->file('photo');
            $new_name = rand(). '.' . $file->getClientOriginalExtension();
            $is_move = $file->move($this->file_path, $new_name);
            if ($is_move) 
            {
                $news->cover_photos = (isset($new_name)) ? $new_name : NULL;
                $news->save();

                alert()->success('Successfully Uploaded!')->persistent('Ok');
                return back();
            }
            else
            {
                alert()->error('Failed to Upload!')->persistent('Ok');
                return back();  
            }
        } 
    }

    public function changeStatus($id)
    {
        $news = News::find($id);
        if (!$news->is_published) {
            $news->is_published = TRUE;
            $message = 'Published';
        }
        else
        {
            $news->is_published = FALSE;
            $message = 'Unpublished';
        }
        $news->save();
        return response()->json(['done' => TRUE, 'message' => $message]);
    }
}
