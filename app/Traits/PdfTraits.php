<?php

namespace App\Traits;

use PDF;
use Auth;

trait PdfTraits
{
    public function exportToPdf($view,$data)
    {
    	$customPaper = array(0,0,612,936);

        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView($view, compact('data'))->setPaper($customPaper,'portrait');
        // If you want to store the generated pdf to the server then you can use the store function
        //$pdf->save($this->file_path.$user_research_report.'.pdf');
        // Finally, you can download the file using download function
        //return $pdf->download(Auth::user()->campuses.rand().".pdf");
        return $pdf->stream(Auth::user()->campuses.rand().".pdf");
    }
}