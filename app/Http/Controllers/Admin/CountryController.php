<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CountryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Models\Country\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function index(CountryDataTable $countryDataTable)
    {
        return $countryDataTable->render('admin.countries.index');
    }


    public function create()
    {
        $locales = config('translatable.locales');
        return view('admin.countries.create',compact('locales'));

    }


    public function store(CountryRequest $request,Country $country)
    {
        $data=$request->validated();
        $country->fill($data)->save();
        return redirect()->route('admin.countries.index')->with('success',trans('created_successfully'));
    }


    public function edit(Country $country)
    {
        $locales = config('translatable.locales');
        return view('admin.countries.edit',compact('locales','country'));
    }


    public function update(CountryRequest $request, Country $country)
    {
        $data=$request->validated();
        $country->fill($data)->save();
        return redirect()->route('admin.countries.index')->with('success',trans('updated_successfully'));
    }


    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('admin.countries.index')->with('success',trans('deleted_successfully'));

    }
}
