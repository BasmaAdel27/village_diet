<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\FaqsDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqsRequest;
use App\Models\Faq\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.common_questions.index')->only(['index']);
        $this->middleware('permission:admin.common_questions.store')->only(['store']);
        $this->middleware('permission:admin.common_questions.update')->only(['update']);
        $this->middleware('permission:admin.common_questions.show')->only(['show']);
        $this->middleware('permission:admin.common_questions.destroy')->only(['destroy']);
    }
    public function index(FaqsDatatable $faqsDatatable)
    {
        return $faqsDatatable->render('admin.faqs.index');
    }


    public function create()
    {
        $locales = config('translatable.locales');
        return view('admin.faqs.create',compact('locales'));
    }


    public function store(FaqsRequest $request,Faq $faq)
    {
        $data=$request->validated();
        $faq->fill($data)->save();
        return redirect()->route('admin.common_questions.index')->with('success',@trans('created_successfully'));
    }


    public function show($id)
    {
        $commonQuestion=Faq::find($id);
        $locales = config('translatable.locales');
        return view('admin.faqs.show',compact('commonQuestion','locales'));
    }


    public function edit($id)
    {
        $locales = config('translatable.locales');
        $commonQuestion=Faq::find($id);
        return view('admin.faqs.edit',compact('locales','commonQuestion'));
    }


    public function update(FaqsRequest $request, $id)
    {
        $data=$request->validated();
        $commonQuestion=Faq::find($id);
        $commonQuestion->fill($data)->save();
        return redirect()->route('admin.common_questions.index')->with('success',@trans('updated_successfully'));
    }


    public function destroy($id)
    {
        $commonQuestion=Faq::find($id)->delete();
        return redirect()->back();
    }
}
