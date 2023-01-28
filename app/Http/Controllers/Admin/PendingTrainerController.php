<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PendingTrainerDatatable;
use App\Http\Controllers\Controller;
use App\Mail\DeclinePendingTrainer;
use App\Mail\SubmitPendingTrainer;
use App\Models\Country\Country;
use App\Models\OldTrainer;
use App\Models\State\State;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PendingTrainerController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:admin.pending-trainers.index')->only(['index']);
        $this->middleware('permission:admin.pending-trainers.update')->only(['update']);
    }

    public function index(PendingTrainerDatatable $pendingTrainerDatatable)
    {
        return $pendingTrainerDatatable->render('admin.pending_trainers.index');
    }

    public function edit($id)
    {
        $trainer = Trainer::find($id);
        $locales = config('translatable.locales');
        $countries = Country::join('country_translations', 'countries.id', 'country_translations.country_id')
            ->where('locale', app()->getLocale())
            ->select('name', 'countries.id')
            ->pluck('name', 'id');
        $states = State::where('country_id', $trainer->user->country_id)
            ->join('state_translations', 'states.id', 'state_translations.state_id')
            ->where('locale', app()->getLocale())
            ->select('name', 'states.id')
            ->pluck('name', 'id');;

        return view('admin.pending_trainers.edit', compact('trainer', 'states', 'locales', 'countries'));
    }


    public function submit(Request $request, $id)
    {
        $data = $this->validate(
            $request,
            [
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]
        );
        $trainer = Trainer::find($id);

        $email = $request->email;
        $password = $request->password;

        Mail::to($trainer->user->email)->send(new SubmitPendingTrainer($trainer, $email, $password));
        $trainer->status = "DONE";
        $trainer->user()->update(['password' => Hash::make($password)]);
        $trainer->save();

        return redirect()->route('admin.pending-trainers.index')->with('success', trans('submitted_successfully'));
    }


    public function declined(Request $request, $id)
    {
        $data = $this->validate(
            $request,
            [
                'reason' => 'required|string',
            ]
        );
        $trainer = Trainer::find($id);
        $reason = $request->reason;
        Mail::to($trainer->user->email)->send(new DeclinePendingTrainer($trainer, $reason));
        $trainer->status = "DECLINED";
        $trainer->save();

        OldTrainer::create([
            'trainers' => array_merge($trainer->user->toArray(), $trainer->toArray())
        ]);
        $trainer->delete();
        $trainer->user()->delete();

        return redirect()->route('admin.pending-trainers.index')->with('success', trans('submitted_successfully'));
    }
}
