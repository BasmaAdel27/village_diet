<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\AdminDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.admins.index')->only(['index']);
        $this->middleware('permission:admin.admins.store')->only(['store']);
        $this->middleware('permission:admin.admins.update')->only(['update']);
        $this->middleware('permission:admin.admins.destroy')->only(['destroy']);
    }

    public function index(AdminDatatable $adminDatatable)
    {
        return $adminDatatable->render('admin.admins.index');
    }

    public function create()
    {
        $roles = Role::whereNotIn('name', ['user', 'trainer'])->pluck('name', 'id');

        return view('admin.admins.create', compact('roles'));
    }


    public function store(AdminRequest $request, User $admin)
    {
        $data = $request->validated();
        $admin->fill($data)->save();
        $admin->assignRole(Role::findById($data['role_id']));

        return redirect()->route('admin.admins.index')->with('success', trans('created_successfully'));
    }

    public function edit(User $admin)
    {
        $roles = Role::whereNotIn('name', ['user', 'trainer'])->pluck('name', 'id');

        return view('admin.admins.edit', compact('admin', 'roles'));
    }

    public function update(AdminRequest $request, User $admin)
    {
        $data = $request->validated();
        $admin->fill($data)->save();
        $admin->assignRole(Role::findById($data['role_id']));

        return redirect()->route('admin.admins.index')->with('success', trans('updated_successfully'));
    }

    public function destroy(User $admin)
    {
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', trans('deleted_successfully'));
    }
}
