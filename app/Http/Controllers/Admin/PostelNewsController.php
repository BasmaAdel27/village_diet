<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\PostelNewsDatatable;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;

class PostelNewsController extends Controller
{

    public function index(PostelNewsDatatable $postelNewsDatatable)
    {
        return $postelNewsDatatable->render('admin.postel_news.index');
    }

    public function create()
    {
        return view('admin.postel_news.create');
    }

    public function store()
    {
        # code...
    }

    public function destroy($id)
    {
        Subscriber::find($id)->delete();

        return redirect()->route('admin.postel_news.index')->with('success', trans('deleted_successfully'));
    }
}
