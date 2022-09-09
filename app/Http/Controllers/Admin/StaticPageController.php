<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\StaticPageDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StaticPageRequest;
use App\Models\StaticPage\StaticPage;

class StaticPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.static_pages.index')->only(['index']);
        $this->middleware('permission:admin.static_pages.store')->only(['store']);
        $this->middleware('permission:admin.static_pages.update')->only(['update']);
        $this->middleware('permission:admin.static_pages.destroy')->only(['destroy']);
    }

    public function index(StaticPageDatatable $staticPageDatatable)
    {
        return $staticPageDatatable->render('admin.static_pages.index');
    }


    public function create()
    {
        $locales = config('translatable.locales');

        return view('admin.static_pages.create', compact('locales'));
    }

    public function store(StaticPageRequest $request, StaticPage $staticPage)
    {
        $data = $request->validated();
        $staticPage->fill($data)->save();

        return redirect()->route('admin.static_pages.index')->with('success', trans('created_successfully'));
    }

    public function edit(StaticPage $staticPage)
    {
        $locales = config('translatable.locales');

        return view('admin.static_pages.edit', compact('locales', 'staticPage'));
    }

    public function update(StaticPageRequest $request, StaticPage $staticPage)
    {
        $data = $request->validated();
        $staticPage->fill($data)->save();

        return redirect()->route('admin.static_pages.index')->with('success', trans('updated_successfully'));
    }

    public function destroy(StaticPage $staticPage)
    {
        $staticPage->delete();

        return redirect()->route('admin.static_pages.index')->with('success', trans('deleted_successfully'));
    }
}
