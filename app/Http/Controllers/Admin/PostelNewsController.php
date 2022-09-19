<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PostelNewsDatatable;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class PostelNewsController extends Controller
{

    public function index(PostelNewsDatatable $postelNewsDatatable)
    {
        return $postelNewsDatatable->render('admin.postelNews.index');

    }

    public function create()
    {
        return view('admin.postelNews.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
        # code...
    }



    public function destroy($id)
    {
        Subscriber::find($id)->delete();
        return redirect()->route('admin.PostelNews.index')->with('success',trans('deleted_successfully'));
    }
}
