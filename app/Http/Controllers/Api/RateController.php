<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RateRequest;
use App\Http\Resources\Api\RatingResource;
use willvincent\Rateable\Rating;

class RateController extends Controller
{
    public function index()
    {
        $rating = Rating::where('user_id', auth()->id())
            ->where('created_at', '>=', now()->startOfMonth())
            ->where('created_at', '<=', now()->endOfMonth())->first();

        return successResponse(RatingResource::make($rating));
    }

    public function store(RateRequest $request)
    {
        $trainer = auth()->user()->society?->trainer;

        if (!$trainer) return failedResponse(__('not_in_society'));

        if (!$rating = Rating::where('user_id', auth()->id())
            ->where('created_at', '>=', now()->startOfMonth())
            ->where('created_at', '<=', now()->endOfMonth())->exists()) {

            $trainer->rate($request->validated()['rating'], @$request->validated()['comment']);

            return successResponse(RatingResource::make($trainer->ratings()->where('user_id', auth()->id())->first()), message: trans('rating_success'));
        } else {
            $rating = $trainer->ratings()->where('user_id', auth()->id())->first();

            return successResponse(RatingResource::make($rating), message: trans('rating_done_before'));
        }
    }
}
