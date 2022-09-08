<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SliderDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.sliders.index')->only(['index']);
        $this->middleware('permission:admin.sliders.store')->only(['store']);
        $this->middleware('permission:admin.sliders.update')->only(['update']);
        $this->middleware('permission:admin.sliders.destroy')->only(['destroy']);
    }

    public function index(SliderDatatable $sliderDatatable)
    {
        return $sliderDatatable->render('admin.sliders.index');
    }


    public function create()
    {
        $locales = config('translatable.locales');

        return view('admin.sliders.create', compact('locales'));
    }

    public function store(SliderRequest $request, Slider $slider)
    {
        $data = $request->validated();
        $slider->fill($data)->save();

        return redirect()->route('admin.sliders.index')->with('success', trans('created_successfully'));
    }

    public function edit(Slider $slider)
    {
        $locales = config('translatable.locales');

        return view('admin.sliders.edit', compact('locales', 'slider'));
    }

    public function update(SliderRequest $request, Slider $slider)
    {
        $data = $request->validated();
        $slider->fill($data)->save();

        return redirect()->route('admin.sliders.index')->with('success', trans('updated_successfully'));
    }


    public function destroy(Slider $slider)
    {
        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', trans('deleted_successfully'));
    }
}
