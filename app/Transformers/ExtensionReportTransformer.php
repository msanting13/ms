<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\ExtensionReport;

class ExtensionReportTransformer extends TransformerAbstract
{
    /**
     * @param \App\ExtensionReport $report
     * @return array
     */
    public function transform(ExtensionReport $report)
    {
        return [
            'id' => (int) $report->id,
            'title' => (string) $report->title,
            'project_cost' => (string) $report->project_cost,
            'funding_source' => (string) $report->funding_source,
            'agency' => (string) $report->agency,
            'sdgs_addressed' => (string) $report->sdgs_addressed,
            'submitted_by' => (string) $report->users->name.'|'.$report->users->campuses.' Campus',
            'created_at' => (string) $report->created_at,
            'action' => view('admin.crud-form.crud-btn.extension-btn', compact('report'))->render(),
        ];
    }
}