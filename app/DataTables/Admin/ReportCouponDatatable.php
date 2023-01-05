<?php

namespace App\DataTables\Admin;

use App\Models\Coupon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ReportCouponDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->addIndexColumn()
            ->eloquent($query);
    }

    public function query()
    {
        return Coupon::select('*')->newQuery();
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
            Column::make('DT_RowIndex')->name('DT_RowIndex')->title(trans('ID'))->orderable(false)->searchable(false),            Column::make('code')->title(trans('code')),
            Column::make('amount')->title(trans('amount')),
            Column::make('max_used')->title(trans('max_used')),
            Column::make('used_times')->title(trans('used_times')),
        ];
    }


    protected function filename()
    {
        return 'Admin/Coupon_' . date('YmdHis');
    }
}
