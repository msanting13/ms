<?php

namespace App\Http\Controllers;

use App\Card;
use App\Role;
use Illuminate\Support\HtmlString;
use Illuminate\Http\Request;

class ExtensionBoardsController extends Controller
{
    public function countUsers()
    {
        $role = Role::with('users')->where('name','role_user')->first();
        return $role->users->count();
    }
    public function extensionCardData($type)
    {
        return datatables()->of(Card::query()->where('type',$type))->addColumn('status', function ($card) {
            return new HtmlString(($card->is_lock) ? '<i class="fas fa-lock" style="color: #e74a3b;"></i>' : '<i class="fas fa-unlock" style="color: #36b9cc;"></i>');
        })->addColumn('counts', function ($card) {
            $totalSubmitted = $card->extensionReports->count();
            $totalUsers = $this->countUsers();
            $percentage = ($totalSubmitted > 0) ? ceil(($totalSubmitted / $totalUsers) * 100) : 0 ;
            return new HtmlString('<h4 class="small font-weight-bold">Total '.$card->extensionReports->count().'<span class="float-right">'.$percentage.'%</span></h4><div class="progress mb-4"><div class="progress-bar" role="progressbar" style="width: '.$percentage.'%" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100"></div></div>');
        })->addColumn('action', function ($card) {
            return view('admin.crud-form.crud-btn.cards-btn', compact('card'));
        })->make(true);   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.extension-boards');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
