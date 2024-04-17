<?php

namespace App\Services;

use App\Models\Report;

class WebsiteService
{
    /**
     * Get all websites reports
     */
    public function getWebsitesReports(): array
    {
        $reports = Report::selectRaw('date,
                                      SUM(revenue) AS revenue,
                                      SUM(impressions) AS impressions,
                                      SUM(clicks) AS clicks,
                                      (SUM(revenue)*1000/SUM(impressions)) AS cpm')->groupBy('date')->get();
        $reportsArray = $reports->pluck(null, 'date')->toArray();
        $total = ['revenue' => $reports->sum('revenue'), 'impressions' => $reports->sum('impressions'), 'clicks' => $reports->sum('clicks'), 'cpm' => $reports->sum('cpm')];
        $reportsArray['total'] = $total;

        return $reportsArray;
    }

    /**
     * Get reports of one website
     */
    public function getWebsiteReport(int $id): array
    {
        $reports = Report::where('website_id', $id)->selectRaw('date,
                         SUM(revenue) AS revenue,
                         SUM(impressions) AS impressions,
                         SUM(clicks) AS clicks,
                         (SUM(revenue)*1000/SUM(impressions)) AS cpm')->groupBy('date')->get();
        $reportsArray = $reports->pluck(null, 'date')->toArray();
        $total = ['revenue' => $reports->sum('revenue'), 'impressions' => $reports->sum('impressions'), 'clicks' => $reports->sum('clicks'), 'cpm' => $reports->sum('cpm')];
        $reports['total'] = $total;

        return $reportsArray;
    }
}
