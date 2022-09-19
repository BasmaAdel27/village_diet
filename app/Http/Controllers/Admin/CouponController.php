<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CouponsDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponRequest;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->activate_date = Carbon::parse(request('activate_date'))->format('Y-m-d H:m:s');
        $this->end_date   = Carbon::parse(request('end_date'))->format('Y-m-d H:m:s');
    }
    public function index(CouponsDatatable $couponsDatatable)
    {
        return $couponsDatatable->render('admin.coupons.index');
    }

    public function create()
    {
        return view('admin.coupons.create');
    }


    public function store(CouponRequest $request,Coupon $coupon)
    {
        $data=$request->validated();
        $coupon->fill($data)->save();

        return redirect()->route('admin.coupons.index')->with('success',trans('created_successfully'));
    }


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
        $coupon=Coupon::find($id);
        return view('admin.coupons.edit',compact('coupon'));
    }


    public function update(CouponRequest $request, $id)
    {
        $data=$request->validated();
        $coupon=Coupon::find($id);
        $coupon->fill($data)->save();
        return redirect()->route('admin.coupons.index')->with('success',trans('updated_successfully'));
    }


    public function destroy($id)
    {
        Coupon::find($id)->delete();
        return redirect()->route('admin.coupons.index')->with('success',trans('deleted_successfully'));
    }
}
