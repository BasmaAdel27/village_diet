<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ContactUsDatatable;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{

    public function index(ContactUsDatatable $contactUsDatatable)
    {
        return $contactUsDatatable->render('admin.contact_us.index');
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
        $contactUs=ContactUs::find($id);
        return view('admin.contact_us.show',compact('contactUs'));

    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        ContactUs::find($id)->delete();
        return redirect()->route('admin.contactUs.index')->with('success', trans('deleted_successfully'));

    }
}
