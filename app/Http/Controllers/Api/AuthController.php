<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Resources\Api\AuthResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $data = $request->validated();

        if (!in_array($data['user_number'], User::pluck('user_number')->toArray())) {
            return failedResponse(Lang::get('user_number_not_correct'));
        }

        $user = User::firstWhere([
            'user_number' => $data['user_number'],
        ]);

        if (!$user) return failedResponse(Lang::get('user_not_found'));
        if (!$user->is_active) return failedResponse(Lang::get('connect_with_support'));
        Auth::loginUsingId($user->id);

        $user->token = $user->createToken('village_diet')->plainTextToken;

        return successResponse(AuthResource::make($user));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        auth()->user()->fill($request->validated())->save();

        return successResponse(AuthResource::make(auth()->user()), message: trans('updated_successfully'));
    }
}
