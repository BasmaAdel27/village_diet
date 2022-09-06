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
            $data = DB::table('roles')->where([['name','!=','admin'],['name','!=','user'],['name','!=','trainer']])->get();
            return DataTables::of($data)
                  ->addIndexColumn()
                  ->addColumn('action', function($row){

                      $actionBtn = "<a href='/en/admin/users/1/edit' class='show btn btn-info btn-sm mr-1'>Show</a>
                                   <a href='#' class='edit btn btn-success btn-sm mr-1'>Edit</a>
                                   <a href='#' class='delete btn btn-danger btn-sm'>Delete</a>";
                      return $actionBtn;
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
        $permissions=Permission::all();
        return view('admin.permissions.create',compact('permissions'));
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
              'role_name' =>'required|unique:roles,name',
              'permission' => 'required',

        ]);        $role=Role::create([
              'name'=>$request->role_name
        ]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('admin.permissions.index')->with('success','Role created successfully');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();

        return redirect()->route('admin.permissions.index')->with('success','Role deleted successfully');
    }
}
