<?php

namespace App\Http\Controllers;

use App\Card;
use App\Role;
use Illuminate\Http\Request;
use App\Traits\DateTrait;
use Illuminate\Support\HtmlString;
class ResearchBoardsController extends Controller
{
    
    use DateTrait;

    public function countUsers()
    {
        $role = Role::with('users')->where('name','role_user')->first();
        return $role->users->count();
    }
    public function researchCardsData($type)
    {
        return datatables()->of(Card::query()->where('type',$type))->addColumn('status', function ($card) {
            return new HtmlString(($card->is_lock) ? '<i class="fas fa-lock" style="color: #e74a3b;"></i>' : '<i class="fas fa-unlock" style="color: #36b9cc;"></i>');
        })->addColumn('counts', function ($card) {
            $totalSubmitted = $card->researchReports->count();
            $totalUsers = $this->countUsers();
            $percentage = ($totalSubmitted > 0) ? ceil(($totalSubmitted / $totalUsers) * 100) : 0 ;
            return new HtmlString('<h4 class="small font-weight-bold">Total '.$card->researchReports->count().'<span class="float-right">'.$percentage.'%</span></h4><div class="progress mb-4"><div class="progress-bar" role="progressbar" style="width: '.$percentage.'%" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100"></div></div>');
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
        return view('admin.research-boards');
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
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function show(Research $research)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function edit(Research $research)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Research $research)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function destroy(Research $research)
    {
        //
    }
}
