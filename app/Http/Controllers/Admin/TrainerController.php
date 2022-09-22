<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\TrainerDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrainerRequest;
use App\Models\Country\Country;
use App\Models\State\State;
use App\Models\Trainer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.trainers.index')->only(['index']);
        $this->middleware('permission:admin.trainers.store')->only(['store']);
        $this->middleware('permission:admin.trainer.update')->only(['update']);
        $this->middleware('permission:admin.trainers.destroy')->only(['destroy']);
    }
    public function index(TrainerDatatable $trainerDatatable)
    {
        return $trainerDatatable->render('admin.trainers.index');
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
        return view('admin.trainers.create', compact('locales', 'countries', 'states'));
    }

    public function fetchState(Request $request)

    {
        $data['states'] = State::where('country_id', $request->country_id)->join('state_translations', 'states.id', 'state_translations.state_id')
            ->where('locale', app()->getLocale())
            ->select('name', 'states.id')
            ->pluck('name', 'id');
        return response()->json($data['states']);
    }
    public function store(TrainerRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'insta_link' => $request->instagram,
            'twitter_link' => $request->twitter,
            'country_id' => $request->countries,
            'state_id' => $request->states,
            'address' => $request->address,
            'password' => $request->password,
            'email_verified_at' => Carbon::now()
        ]);

        $user->assignRole('trainer');
        $trainer = Trainer::create([
            'bio' => $request->bio,
            'current_job' => $request->current_job,
            'body_shape' => $request->body_shape,
            'join_request_reason' => $request->join_request_reason,
            'is_certified' => $request->is_certified,
            'show_inPage' => $request->show_inPage,
            'status' => 'DONE',
            'user_id' => $user->id
        ]);

        return redirect()->route('admin.trainers.index')->with('success', trans('created_successfully'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $trainer = Trainer::find($id);
        //        dd($trainer->user->address);
        $locales = config('translatable.locales');
        $countries = Country::join('country_translations', 'countries.id', 'country_translations.country_id')
            ->where('locale', app()->getLocale())
            ->select('name', 'countries.id')
            ->pluck('name', 'id');
        $states = State::where('country_id', $trainer->user->country_id)->join('state_translations', 'states.id', 'state_translations.state_id')
            ->select('name', 'states.id')
            ->pluck('name', 'id');;

        return view('admin.trainers.edit', compact('trainer', 'states', 'locales', 'countries'));
    }


    public function update(TrainerRequest $request, Trainer $trainer)
    {
        $data = $request->validated();
        $trainer->user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'insta_link' => $request->instagram,
            'twitter_link' => $request->twitter,
            'country_id' => $request->countries,
            'state_id' => $request->states,
            'address' => $request->address,
            'password' => $request->password,
        ]);

        $trainer->update([
            'bio' => $request->bio,
            'current_job' => $request->current_job,
            'body_shape' => $request->body_shape,
            'join_request_reason' => $request->join_request_reason,
            'is_certified' => $request->is_certified,
            'show_inPage' => $request->show_inPage,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.trainers.index')->with('success', trans('updated_successfully'));
    }

    public function destroy($id)
    {

        $trainer=Trainer::find($id);
        $user=User::find($trainer->user_id)->delete();
        return redirect()->route('admin.trainers.index')->with('success', trans('deleted_successfully'));
    }
}
