<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ServiceDatatable;
use App\DataTables\Admin\ServiceWorkWayDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service\Service;
use App\Models\Setting;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.services.index')->only(['index']);
        $this->middleware('permission:admin.services.store')->only(['store']);
        $this->middleware('permission:admin.services.update')->only(['update']);
        $this->middleware('permission:admin.services.destroy')->only(['destroy']);
    }

    public function index(ServiceDatatable $serviceDatatable)
    {
        return $serviceDatatable->render('admin.services.index');

    }



    public function create(Service $service)
    {
        $locales = config('translatable.locales');

        return view('admin.services.create', compact('locales', 'service'));
    }

    public function store(ServiceRequest $request, Service $service)
    {
        $data = $request->validated();
        $service->fill($data)->save();
        if ($request->type == 'Store') {
            return redirect()->route('admin.services.index', ['type' => 'Store'])->with('success', trans('created_successfully'));
        }
        return redirect()->route('admin.services.index',['type'=>'WorkWay'])->with('success', trans('created_successfully'));
    }

    public function edit(Service $service)
    {
        $locales = config('translatable.locales');

        return view('admin.services.edit', compact('locales', 'service'));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $data = $request->validated();
        $service->fill($data)->save();

        if ($request->type =='Store') {
            return redirect()->route('admin.services.index', ['type' => 'Store'])->with('success', trans('updated_successfully'));
        }else{
            return redirect()->route('admin.services.index', ['type' => 'WorkWay'])->with('success', trans('updated_successfully'));

        }
        }


    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', trans('deleted_successfully'));
    }

    public function showSection(Request $request)
    {
        $setting = Setting::first();
        if ($request->type=='Store'){
        $setting->update([
              'show_store' => true,
        ]);
            return redirect()->route('admin.services.index',['type'=>'Store'])->with('success', trans('updated_successfully'));

        }else{

            $setting->update([
                  'show_workWay' => true,
                ]);
            return redirect()->route('admin.services.index',['type'=>'WorkWay'])->with('success', trans('updated_successfully'));

        }

    }



    public function disableSection(Request $request)
    {
        $setting = Setting::first();
        if ($request->type=='Store'){
            $setting->update([
                  'show_store' => false,
            ]);
            return redirect()->route('admin.services.index',['type'=>'Store'])->with('success', trans('updated_successfully'));

        }else{
            $setting->update([
                  'show_workWay' => false,
            ]);
            return redirect()->route('admin.services.index',['type'=>'WorkWay'])->with('success', trans('updated_successfully'));

        }

    }
}
