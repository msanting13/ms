<?php

namespace App\Http\Controllers\Admin;

use App\Card;
use App\User;
use App\ResearchReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboards');
    }

    public function noOfUsers()
    {
        return User::whereHas('roles', function($query){
            $query->where('name','role_user')->orWhere('name', 'role_director');
        })->count();
    }

    public function researchProgressStatus()
    {
        return datatables()->of(Card::query()->where('type', 'research')->where('is_published', true))
        ->addColumn('status', function ($card) {
            return new HtmlString(($card->is_lock) ? '<i class="fas fa-lock" style="color: #e74a3b;"></i>' : '<i class="fas fa-unlock" style="color: #36b9cc;"></i>');
        })->addColumn('progress', function ($card) {
            $totalSubmitted = $card->researchReports->where('is_published', true)->groupBy('user_id')->count();
            $totalUsers = $this->noOfUsers();
            $percentage = ($totalSubmitted > 0) ? ceil(($totalSubmitted / $totalUsers) * 100) : 0 ;
            return new HtmlString('<h4 class="small font-weight-bold">Total no. of user who submitted '.$totalSubmitted.'<span class="float-right">'.$percentage.'%</span></h4><div class="progress mb-4"><div class="progress-bar" role="progressbar" style="width: '.$percentage.'%" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100"></div></div>');
        })->make(true);
    }

    public function extensionProgressStatus()
    {
        return datatables()->of(Card::query()->where('type', 'extension')->where('is_published', true))
        ->addColumn('status', function ($card) {
            return new HtmlString(($card->is_lock) ? '<i class="fas fa-lock" style="color: #e74a3b;"></i>' : '<i class="fas fa-unlock" style="color: #36b9cc;"></i>');
        })->addColumn('progress', function ($card) {
            $totalSubmitted = $card->extensionReports->where('is_published', true)->groupBy('user_id')->count();
            $totalUsers = $this->noOfUsers();
            $percentage = ($totalSubmitted > 0) ? ceil(($totalSubmitted / $totalUsers) * 100) : 0 ;
            return new HtmlString('<h4 class="small font-weight-bold">Total no. of user who submitted '.$totalSubmitted.'<span class="float-right">'.$percentage.'%</span></h4><div class="progress mb-4"><div class="progress-bar" role="progressbar" style="width: '.$percentage.'%" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100"></div></div>');
        })->make(true);
    }
}
