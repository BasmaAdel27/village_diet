<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\MealDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MealRequest;
use App\Models\Day\Day;
use App\Models\Meal\Meal;

class MealController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.meals.index')->only(['index']);
        $this->middleware('permission:admin.meals.store')->only(['store']);
        $this->middleware('permission:admin.meals.update')->only(['update']);
        $this->middleware('permission:admin.meals.destroy')->only(['destroy']);
    }

    public function index(MealDatatable $mealDatatable)
    {
        return $mealDatatable->render('admin.meals.index');
    }

    public function create()
    {
        $locales = config('translatable.locales');
        $days = Day::join('day_translations', 'days.id', 'day_translations.day_id')
            ->where('locale', app()->getLocale())
            ->select('title', 'days.id')
            ->pluck('title', 'id');

        return view('admin.meals.create', compact('locales', 'days'));
    }


    public function store(MealRequest $request, Meal $meal)
    {
        $data = $request->validated();
        $meal->fill($data)->save();
        return redirect()->route('admin.meals.index')->with('success', trans('created_successfully'));
    }

    public function edit($id)
    {
        $meal = Meal::find($id);
        $locales = config('translatable.locales');
        $days = Day::join('day_translations', 'days.id', 'day_translations.day_id')
            ->where('locale', app()->getLocale())
            ->select('title', 'days.id')
            ->pluck('title', 'id');

        return view('admin.meals.edit', compact('locales', 'days', 'meal'));
    }


    public function update(MealRequest $request, $id)
    {
        $data = $request->validated();
        $meal = Meal::find($id);
        $meal->fill($data)->save();

        return redirect()->route('admin.meals.index')->with('success', 'updated_successfully');
    }

    public function destroy($id)
    {
        Meal::find($id)->delete();

        return redirect()->route('admin.meals.index')->with('success', trans('deleted_successfully'));
    }
}
