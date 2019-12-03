<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ResearchCard;
use App\Reportable;
use Auth;

class UserReportsController extends Controller
{
    public function __construct()
    {
        $this->file_path = public_path('/public_files/');
    }

    public function create($id)
    {
        $researchCard = ResearchCard::find($id);
        return view('users.user-submit-report', compact('researchCard','id'));
    }

    public function researchReportStore(Request $request, $id)
    {
    	$researchCard = ResearchCard::find($id);

        $file = $request->file('file');

        if (!is_dir($this->file_path)) 
        {
            mkdir($this->file_path, 0777);
        }

		$new_name = rand(). '.' . $file->getClientOriginalExtension();
		$is_move = $file->move($this->file_path, $new_name);
		if ($is_move) 
		{
			$researchCard->reports()->create([
				'name'  		=>      $request->name,
				'file'          =>      $new_name,
				'user_id'       =>      Auth::user()->id
			]);
		}
    }
    public function researchReportEdit($id)
    {
        $report = Reportable::find($id);
        return view('users.user-edit-report', compact('report','id'));
    }    
    public function researchReportUpdate(Request $request, $id)
    {
        $report = Reportable::find($id);
        $report->name = $request->name;
        $report->save();

        return redirect()->back();
    }
    public function researchReportFileEdit($id)
    {
        $report = Reportable::find($id);
        return view('users.user-edit-report-file', compact('report','id'));
    }
    public function researchReportFileUpdate(Request $request, $id)
    {
        $report = Reportable::find($id);

        $file = $request->file('file');
        $new_name = rand(). '.' . $file->getClientOriginalExtension();
        $is_move = $file->move($this->file_path, $new_name);

        if ($is_move) 
        {
            $report->file = $new_name;
            $report->save();
        }

        return redirect()->back();
    }   
}
