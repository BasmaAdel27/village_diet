<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserDatatable $userDatatable)
    {
        return $userDatatable->render('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        return view('admin.users.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
