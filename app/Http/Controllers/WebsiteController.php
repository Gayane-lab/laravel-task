<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebsiteRequest;
use App\Http\Resources\WebsiteCollection;
use App\Http\Resources\WebsiteResource;
use App\Models\Website;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class WebsiteController extends Controller
{
    use AuthorizesRequests;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get all websites with pagination
     *
     * @throws AuthorizationException
     */
    public function index(WebsiteRequest $websiteRequest): WebsiteCollection
    {
        $this->authorize('viewAny', Website::class);

        $limit = $websiteRequest->input('limit', 20);
        $page = $websiteRequest->input('page', 1);

        return new WebsiteCollection(Website::query()->paginate($limit, ['*'], 'page', $page));
    }

    /**
     * Create new resource
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->all();
        $validator = Validator::make($data, ['url' => 'required|url']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $resource = Website::create($data);

        return response()->json(new WebsiteResource($resource));
    }

    /**
     * Get one website's data
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $website = Website::findOrFail($id);
        return response()->json(new WebsiteResource($website));
    }

    /**
     * Update website
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $data = Website::findorFail($id);
        $validator = Validator::make($request->all(), ['url' => 'required|url']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $data->url = $request->input('url');
        return response()->json(new WebsiteResource($data->save()));
    }

    /**
     * Delete website and reports
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $website = Website::findOrFail($id);
        $website->reports()->delete();
        return response()->json(new WebsiteResource($website->destroy($id)));
    }
}
