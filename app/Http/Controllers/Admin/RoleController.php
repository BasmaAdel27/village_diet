<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RoleDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.roles.index')->only(['index']);
        $this->middleware('permission:admin.roles.store')->only(['store']);
        $this->middleware('permission:admin.roles.update')->only(['update']);
        $this->middleware('permission:admin.roles.destroy')->only(['destroy']);
    }

    public function index(RoleDatatable $roleDatatable)
    {
        return $roleDatatable->render('admin.roles.index');
    }

    public function create()
    {
        $permissions = Permission::where('name', 'like', 'admin.%')->get();

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role_name' => 'required|string|unique:roles,name',
            'permission' => 'required',

        ]);
        $role = Role::create([
            'name' => $request->role_name
        ]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('admin.roles.index')->with('success', trans('created_successfully'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $rolePermissions = $role->permissions()->pluck('permission_id')->toArray();
        $permissions = Permission::where('name', 'like', 'admin.%')->get();

        return view('admin.roles.edit', compact(['role', 'rolePermissions', 'permissions']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role_name' => 'required|string',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        if ($role->name != $request->role_name) {
            $this->validate($request, [
                'role_name' => 'unique:roles,name',
            ]);
        }
        $role->update([
            'name' => $request->role_name,
        ]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('admin.roles.index')->with('success', trans('updated_successfully'));
    }

    public function destroy($id)
    {
        Role::find($id)->delete();

        return redirect()->route('admin.roles.index')->with('success', trans('deleted_successfully'));
    }
}
