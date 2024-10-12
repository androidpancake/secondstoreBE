<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validator = $request->all();
        if ($validator) {
            $data = User::create($validator);
            $success['token'] = $data->createToken('secondstore', ['buyer'])->plainTextToken;
            $success['name'] = $data->name;
            return ApiResponseClass::sendResponse($data, 'success', 201);
        } else {
            return ApiResponseClass::throw($validator);
        }
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            $success['token'] = $user->createToken('secondstore', ['buyer'])->plainTextToken;
            $success['name'] = $user->name;

            return ApiResponseClass::sendResponse($success, 'success', 200);
        } else {
            return ApiResponseClass::throw('unauthorized');
        }
    }
}
