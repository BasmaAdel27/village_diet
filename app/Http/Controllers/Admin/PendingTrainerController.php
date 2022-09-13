<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PendingTrainerDatatable;
use App\Http\Controllers\Controller;
use App\Models\Country\Country;
use App\Models\State\State;
use App\Models\Trainer;
use Illuminate\Http\Request;

class PendingTrainerController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:admin.pendingTrainers.index')->only(['index']);
        $this->middleware('permission:admin.pendingTrainers.update')->only(['update']);
    }
    public function index(PendingTrainerDatatable $pendingTrainerDatatable)
    {
        return $pendingTrainerDatatable->render('admin.pendingTrainers.index');
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
        $trainer=Trainer::find($id);
//        dd($trainer->user->address);
        $locales = config('translatable.locales');
        $countries = Country::join('country_translations', 'countries.id', 'country_translations.country_id')
              ->where('locale', app()->getLocale())
              ->select('name', 'countries.id')
              ->pluck('name', 'id');
        $states=State::where('country_id',$trainer->user->country_id)->join('state_translations', 'states.id', 'state_translations.state_id')
              ->where('locale', app()->getLocale())
              ->select('name', 'states.id')
              ->pluck('name', 'id');;
//dd($trainer->getImageAttribute());
        return view('admin.pendingTrainers.edit',compact('trainer','states','locales','countries'));
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
