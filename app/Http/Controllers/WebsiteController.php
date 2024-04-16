<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Validator;

class WebsiteController extends Controller
{
    /**
     * Get all websites with pagination
     * @return Application|Factory|View|\Illuminate\Foundation\Application|JsonResponse
     */
    public function index()
    {
        if (!auth('sanctum')->check()) {
            return response()->json(['error' => 'Please login.'], 404);
        }
        $websites = Website::paginate(20);
        return view('website.index', compact('websites'));
    }

    /**
     * Set new website
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, ['url' => 'required|url']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        Website::create($data);
        return redirect()->route('website.index');
    }

    /**
     * Show create website view
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('website.create');
    }

    /**
     * Show one website's data
     * @param int $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(int $id)
    {
        $website = Website::findOrFail($id);
        return view('website.show', compact('website'));
    }

    /**
     * Show website's view for editing
     * @param int $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(int $id)
    {
        $website = Website::findOrFail($id);
        return view('website.edit', compact('website'));
    }

    /**
     * Update website
     * @param Request $request
     * @param int $id
     * @return JsonResponse|RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $data = Website::findorFail($id);
        $validator = Validator::make($request->all(), ['url' => 'required|url']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $data->url = $request->input('url');
        $data->save();
        return redirect()->route('website.show', $id);
    }

    /**
     * Delete website and website's reports
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        $website = Website::findOrFail($id);
        $website->reports()->delete();
        $website->destroy($id);
        return redirect()->route('website.index');
    }
}
