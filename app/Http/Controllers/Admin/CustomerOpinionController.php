<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CustomerOpinionDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomerOpinionRequest;
use App\Models\CustomerOpinion;

class CustomerOpinionController extends Controller
{
    public function index(CustomerOpinionDatatable $customerOpinionDatatable)
    {
        return $customerOpinionDatatable->render('admin.customer_opinions.index');
    }


    public function create()
    {
        return view('admin.customer_opinions.create');
    }


    public function store(CustomerOpinionRequest $request,CustomerOpinion $customerOpinion)
    {
        $data=$request->validated();
        $customerOpinion->fill($data)->save();
        return redirect()->route('admin.opinions.index')->with('success',trans('created_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $opinion=CustomerOpinion::find($id);
        return view('admin.customer_opinions.edit',compact('opinion'));


    }


    public function update(CustomerOpinionRequest $request, $id)
    {
        $data=$request->validated();
        $opinion=CustomerOpinion::find($id);
        $opinion->fill($data)->save();
        return redirect()->route('admin.opinions.index')->with('success',trans('updated_successfully'));



    }


    public function destroy($id)
    {
        CustomerOpinion::find($id)->delete();
        return redirect()->route('admin.opinions.index')->with('success',trans('deleted_successfully'));

    }
}
