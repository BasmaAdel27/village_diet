<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AdminDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index(AdminDatatable $adminDatatable)
    {
        return $adminDatatable->render('admin.admins.index');
    }

    public function create()
    {
        $roles = Role::whereNotIn('name', ['user', 'trainer'])->pluck('name', 'id');

        return view('admin.admins.create', compact('roles'));
    }


    public function store(AdminRequest $request, User $user)
    {
        $data = $request->validated();
        $user->fill($data)->save();
        $user->assignRole('admin');

        return redirect()->route('admin.admins.index')->with('success', trans('created_successfully'));
    }

    public function edit(User $admin)
    {
        $roles = Role::whereNotIn('name', ['user', 'trainer'])->pluck('name', 'id');

        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    public function update(Request $request, User $admin)
    {
        $data = $request->validated();
        $admin->fill($data)->save();

        return redirect()->route('admin.admins.index')->with('success', trans('updated_successfully'));
    }

    public function destroy(User $admin)
    {
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', trans('deleted_successfully'));
    }
}
