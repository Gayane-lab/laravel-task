<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    /**
     * Show all websites' reports by dates
     * @return JsonResponse
     */
    public function index()
    {
        if (!auth('sanctum')->check()) {
            return response()->json(['error' => 'Please login.'], 404);
        }
        $reports = Report::selectRaw('date,
                                      SUM(revenue) AS revenue,
                                      SUM(impressions) AS impressions,
                                      SUM(clicks) AS clicks,
                                      (SUM(revenue)*1000/SUM(impressions)) AS cpm')->groupBy('date')->get()->keyBy('date');
        $total = ['revenue' => $reports->sum('revenue'), 'impressions' => $reports->sum('impressions'), 'clicks' => $reports->sum('clicks'), 'cpm' => $reports->sum('cpm')];
        $reports['total'] = $total;
        return response()->json($reports);
    }

    /**
     * Show one website's reports by date
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
    {
        if (!auth('sanctum')->check()) {
            return response()->json(['error' => 'Please login.'], 404);
        }
        if (!Report::where('website_id', $id)->exists()) {
            return response()->json(['error' => 'Id is not exist.'], 404);
        }
        $reports = Report::where('website_id', $id)->selectRaw('date,
                         SUM(revenue) AS revenue,
                         SUM(impressions) AS impressions,
                         SUM(clicks) AS clicks,
                         (SUM(revenue)*1000/SUM(impressions)) AS cpm')->groupBy('date')->get()->keyBy('date');
        $total = ['revenue' => $reports->sum('revenue'), 'impressions' => $reports->sum('impressions'), 'clicks' => $reports->sum('clicks'), 'cpm' => $reports->sum('cpm')];
        $reports['total'] = $total;
        return response()->json($reports);
    }
}
