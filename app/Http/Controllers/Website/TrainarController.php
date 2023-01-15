<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\TrainerRequest;
use App\Models\Country\Country;
use App\Models\State\State;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainarController extends Controller
{

    public function index()
    {
        $trainers = Trainer::where([['show_inPage', 1], ['status', 'DONE']])->with('user')->get();

        return view('website.pages.trainers', compact('trainers'));
    }

    public function create()
    {
        $locales = config('translatable.locales');
        $countries = Country::join('country_translations', 'countries.id', 'country_translations.country_id')
            ->where('locale', app()->getLocale())
            ->select('name', 'countries.id')
            ->pluck('name', 'id');
        $states = State::join('state_translations', 'states.id', 'state_translations.state_id')
            ->where('locale', app()->getLocale())
            ->select('name', 'states.id')
            ->pluck('name', 'id');
        return view('website.pages.register_trainer', compact('locales', 'countries', 'states'));
    }

    public function store(Request $request)
    {
        $arrayRequest = [
            'first_name' => 'required|min:2|max:255',
            'last_name' => 'required|min:2|max:255',
            'phone' => 'required|numeric',
            'bio' => 'required',
            'twitter' => 'nullable|max:255',
            'instagram' => 'nullable|max:255',
            'join_request_reason' => 'required',
            'country_id' => 'required|exists:countries,id',
            'city' => 'nullable',
            'address' => 'required|string',
            'current_job' => 'required|string',
            'body_shape' => 'required',
            'is_certified' => 'required|in:0,1',
            'image' => 'required|image|max:2048',
            'email' => 'required|min:2|max:255|unique:users,email',
            'cv' => 'required|mimes:pdf,doc,docx|max:2048',
        ];
        if ($arrayRequest['is_certified'] == 1) {
            $arrayRequest['confidental_image'] = 'required|image|max:2048';
        }

        $response = Validator::make($request->all(), $arrayRequest);

        if ($response->fails()) {
            return response()->json([
                'response' => false,
                'errors' => $response->getMessageBag()->toArray()
            ], 422);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'insta_link' => $request->instagram,
            'twitter_link' => $request->twitter,
            'country_id' => $request->country_id,
            'city' => $request->city,
            'address' => $request->address,
            'email_verified_at' => now(),
        ]);

        $user->assignRole('trainer');
        Trainer::create([
            'bio' => $request->bio,
            'current_job' => $request->current_job,
            'body_shape' => $request->body_shape,
            'join_request_reason' => $request->join_request_reason,
            'is_certified' => $request->is_certified,
            'show_inPage' => 0,
            'status' => 'PENDING',
            'user_id' => $user->id
        ]);

        return response()->json(['message' => 'success'], 200);
    }
}
