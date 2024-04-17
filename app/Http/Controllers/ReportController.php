<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Report;
use Illuminate\Http\JsonResponse;

class ReportController extends BaseController
{
    /**
     * Show all websites' reports by dates
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $reports = $this->websiteService->getWebsitesReports();
        return response()->json($reports);
    }

    /**
     * Show one website's reports by date
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        if (!Report::where('website_id', $id)->exists()) {
            return response()->json(['error' => 'Id is not exist.'], 404);
        }
        $reports = $this->websiteService->getWebsiteReport($id);
        return response()->json($reports);
    }
}
