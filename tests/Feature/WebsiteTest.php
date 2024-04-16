<?php

namespace Tests\Feature;

use App\Http\Controllers\WebsiteController;
use Illuminate\Http\Request;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    /**
     * Successful create website
     */
    public function testCreateSuccessful(): void
    {
        $controller = new WebsiteController();
        $request = new Request([
            'url' => 'http://www.example.com/'
        ]);
        $response = $controller->store($request);
        $this->assertEquals(302, $response->status());
    }

    /**
     * Create failed - it's not url
     */
    public function testCreateNotUrl(): void
    {
        $controller = new WebsiteController();
        $request = new Request([
            'url' => 'ggfdgfgvbvbfgfgfffffff.'
        ]);
        $response = $controller->store($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Create failed - empty url
     */
    public function testCreateEmptyUrl(): void
    {
        $controller = new WebsiteController();
        $request = new Request([
            'url' => ''
        ]);
        $response = $controller->store($request);
        $this->assertEquals(401, $response->status());
    }

    /**
     * Create failed - url doesn't exist
     */
    public function testCreateUrlNotExist(): void
    {
        $controller = new WebsiteController();
        $request = new Request([

        ]);
        $response = $controller->store($request);
        $this->assertEquals(401, $response->status());
    }
}
