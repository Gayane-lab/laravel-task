<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    */

    use RegistersUsers;


    /**
     * Register user with unique email and checks email, password validation
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $input = $request->all();
        if(!isset($input['password']) || !isset($input['password_confirmation']) || $input['password'] !== $input['password_confirmation']) {
            return response()->json(['error' => 'Passwords are not the same'], 401);
        }
        $validator = Validator::make($input, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|regex:/[0-9]/|regex:/[@$!%*#?&]/|regex:/[a-zA-Z]/'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $token = $user->createToken($request->name)->plainTextToken;
        return response()->json(['token' => $token]);
    }

}
