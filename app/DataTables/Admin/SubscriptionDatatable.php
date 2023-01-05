<?php

namespace App\DataTables\Admin;

use App\Models\Subscription;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SubscriptionDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('Action', function ($query) {
                return view('admin.subscriptions.datatable.action', compact('query'));
            })->editColumn('user.first_name', function ($query) {
                return  $query->user?->first_name . ' ' .  $query->user?->last_name;
            })
            ->editColumn('end_date', function ($query) {
                return  $query->end_date->format('Y-m-d');
            })->rawColumns(['Action']);
    }


    public function query()
    {
        return Subscription::select('subscriptions.*')->with('user')->newQuery();
    }


    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lBfrtip')
            ->orderBy(0)
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
        if (app()->getLocale() == 'ar') {
            $statusColumn = Column::make('status_ar')->title(trans('status_ar'))->orderable(true);
        } else {
            $statusColumn = Column::make('status')->title(trans('status'))->orderable(true);
        }
        return [
            Column::make('DT_RowIndex')->name('DT_RowIndex')->title(trans('ID'))->orderable(false)->searchable(false),
            Column::make('user.first_name')->title(trans('name'))->orderable(false),
            Column::make('created_at')->title(trans('date-from'))->orderable(true),
            Column::make('end_date')->title(trans('end_date'))->orderable(true),
            $statusColumn,
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false),
        ];
    }


    protected function filename()
    {
        return 'Admin/Subscription_' . date('YmdHis');
    }
}
