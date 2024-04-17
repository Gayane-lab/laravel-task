<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    */

    use AuthenticatesUsers;

    /**
     * Users' login function with checking validation
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $user_data = $request->all();
        $validator = Validator::make($user_data, [
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string|min:8|regex:/[0-9]/|regex:/[@$!%*#?&]/|regex:/[a-zA-Z]/'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user = User::where('email',$user_data['email'])->first();
        if(!$user || !Hash::check($user_data['password'],$user->password)) {
            return response()->json(['error' => 'The provided credentials are incorrect.'], 401);
        }
        return response()->json(['token' => $user->createToken($user->name)->plainTextToken]);
    }
}
