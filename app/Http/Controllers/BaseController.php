<?php

namespace App\Http\Controllers;

use App\Services\WebsiteService;

class BaseController extends Controller
{
    public $websiteService;

    public function __construct(WebsiteService $websiteService)
    {
        $this->websiteService = $websiteService;
    }
}
