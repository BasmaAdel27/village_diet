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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                    $id=$row->id;
                    return view('admin.admins.datatable.action',compact('id'));
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.permissions.create', compact('permissions'));
    }
    //
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'role_name' => 'required|unique:roles,name',
            'permission' => 'required',

        ]);
        $role = Role::create([
            'name' => $request->role_name
        ]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role=Role::find($id);
        $rolePermissions = $role->permissions;
        $permissions = Permission::get();

        return view('admin.permissions.edit',compact(['role','rolePermissions','permissions']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
              'role_name' => 'required|',
              'permission' => 'required',
        ]);

        $role=Role::find($id);
        if ($role->name != $request->role_name) {
            $this->validate($request,[
                  'role_name' => 'unique:roles,name',
            ]);
        }
            $role->update([
                  'name' => $request->role_name,
            ]);
            $role->syncPermissions($request->input('permission'));

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::find($id)->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully');
    }
}
