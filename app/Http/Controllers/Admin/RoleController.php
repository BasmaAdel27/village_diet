<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video\video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.permissions.index');
    }


    public function getRoles(Request $request)
    {

        if ($request->ajax()) {

            $data = DB::table('roles')->whereNotIn('name', ['admin', 'trainer', 'user'])->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    return view('admin.permissions.datatable.action', compact('id'));
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.permissions.create', compact('permissions'));
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
        $permissions = Permission::get();

        return view('admin.permissions.edit', compact(['role', 'rolePermissions', 'permissions']));
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
