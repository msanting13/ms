<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\ResearchReport;

class ResearchReportTransformer extends TransformerAbstract
{
    /**
     * @param \App\ResearchReport $report
     * @return array
     */
    public function transform(ResearchReport $report)
    {
        return [
            'id' => (int) $report->id,
            'title' => (string) $report->title,
            'project_cost' => (string) $report->project_cost,
            'funding_source' => (string) $report->funding_source,
            'agency' => (string) $report->agency,
            'sdgs_addressed' => (string) $report->sdgs_addressed,
            'submitted_by' => (string) $report->users->name,
            'campus' => (string) $report->users->campuses,
            'created_at' => (string) $report->created_at,
            'action' => view('admin.crud-form.crud-btn.research-btn', compact('report'))->render(),
        ];
    }
}