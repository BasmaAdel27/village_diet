<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\TemplateDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TemplateRequest;
use App\Models\Template\Template;

class TemplateController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:admin.templates.index')->only(['index']);
        $this->middleware('permission:admin.templates.store')->only(['store']);
        $this->middleware('permission:admin.templates.update')->only(['update']);
        $this->middleware('permission:admin.templates.destroy')->only(['destroy']);
    }

    public function index(TemplateDataTable $templateDataTable)
    {
        return $templateDataTable->render('admin.templates.index');
    }


    public function create()
    {
        $locales = config('translatable.locales');

        return view('admin.templates.create', compact('locales'));
    }

    public function store(TemplateRequest $request, Template $template)
    {
        $data = $request->validated();
        $template->fill($data)->save();

        return redirect()->route('admin.templates.index')->with('success', trans('created_successfully'));
    }

    public function edit(Template $template)
    {
        $locales = config('translatable.locales');

        return view('admin.templates.edit', compact('locales', 'template'));
    }

    public function update(TemplateRequest $request, Template $template)
    {
        $data = $request->validated();
        $template->fill($data)->save();

        return redirect()->route('admin.templates.index')->with('success', trans('updated_successfully'));
    }

    public function destroy(Template $template)
    {
        $template->delete();

        return redirect()->route('admin.templates.index')->with('success', trans('deleted_successfully'));
    }
}
