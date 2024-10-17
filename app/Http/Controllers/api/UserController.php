<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserSavedItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        foreach ($user->savedItems as $saved) {
            array_merge($saved->toArray());
        }

        return ApiResponseClass::sendResponse(new UserResource($user), 'User Retrieved Successfully', 200);
    }

    public function savedItems(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'product_id' => 'exists:products,id',
            'user_id' => 'exists:users,id'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::throw('Validation Error', $validator->errors());
        }

        $data = UserSavedItems::create($input);

        return ApiResponseClass::sendResponse($data, 'Item Saved Successfully', 200);
    }

    public function unsavedItems($product_id)
    {
        UserSavedItems::where('product_id', $product_id)->delete();

        return ApiResponseClass::sendResponse('Unsave Items Successfully', '', 204);
    }
}
