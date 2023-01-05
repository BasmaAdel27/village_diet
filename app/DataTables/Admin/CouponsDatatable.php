<?php

namespace App\DataTables\Admin;

use App\Models\Coupon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CouponsDatatable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('Action', function ($query) {
                return view('admin.coupons.datatable.action', compact('query'));
            })->rawColumns(['Active']);
    }


    public function query()
    {
        return Coupon::select('coupons.*')->newQuery();
    }


    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lBfrtip')
            ->orderBy(1)
            ->lengthMenu([7, 10, 25, 50, 75, 100])
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }


    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->name('DT_RowIndex')->title(trans('ID'))->orderable(false)->searchable(false),              Column::make('code')->title(trans('code'))->orderable(false),
            Column::make('activate_date')->title(trans('activate_date'))->orderable(false),
            Column::make('end_date')->title(trans('end_date')),
            Column::make('amount')->title(trans('amount')),
            Column::make('max_used')->title(trans('max_used')),
            Column::make('used_times')->title(trans('used_times')),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false),
        ];
    }


    protected function filename()
    {
        return 'Coupons_' . date('YmdHis');
    }
}
