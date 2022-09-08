<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\ContactUsDatatable;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;

class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.contactUs.index')->only(['index']);
        $this->middleware('permission:admin.contactUs.show')->only(['show']);
        $this->middleware('permission:admin.contactUs.destroy')->only(['destroy']);
    }

    public function index(ContactUsDatatable $contactUsDatatable)
    {
        return $contactUsDatatable->render('admin.contact_us.index');
    }

    public function show($id)
    {
        $contactUs = ContactUs::find($id);

        return view('admin.contact_us.show', compact('contactUs'));
    }

    public function destroy($id)
    {
        ContactUs::find($id)->delete();

        return redirect()->route('admin.contactUs.index')->with('success', trans('deleted_successfully'));
    }
}
