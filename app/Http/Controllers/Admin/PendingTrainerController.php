<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PendingTrainerDatatable;
use App\Http\Controllers\Controller;
use App\Mail\DeclinePendingTrainer;
use App\Mail\SubmitPendingTrainer;
use App\Models\Country\Country;
use App\Models\State\State;
use App\Models\Trainer;
use Illuminate\Http\Request;
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


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
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
        $states = State::where('country_id', $trainer->user->country_id)
              ->join('state_translations', 'states.id', 'state_translations.state_id')
              ->where('locale', app()->getLocale())
              ->select('name', 'states.id')
            ->pluck('name', 'id');;
        //dd($trainer->getImageAttribute());

        return view('admin.pending_trainers.edit', compact('trainer', 'states', 'locales', 'countries'));
    }


    public function submit(Request $request,$id){
       $data= $this->validate($request,
              [
                    'email' => 'required|email',
                    'password' => 'required|min:8',
            ]);
       $trainer=Trainer::find($id);
       $email=$request->email;
       $password=$request->password;
        Mail::to($trainer->user->email)->send(new SubmitPendingTrainer($trainer,$email,$password));
        $trainer->status="DONE";
        $trainer->user->password=$password;
        $trainer->save();
        return redirect()->route('admin.pending-trainers.index')->with('success', trans('submitted_successfully'));

    }


    public function declined(Request $request,$id){
        $data= $this->validate($request,
              [
                    'reason' => 'required|string',
              ]);
        $trainer=Trainer::find($id);
        $reason=$request->reason;
        Mail::to($trainer->user->email)->send(new DeclinePendingTrainer($trainer,$reason));
        $trainer->status="DECLINED";
        $trainer->save();
        return redirect()->route('admin.pending-trainers.index')->with('success', trans('submitted_successfully'));

    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
