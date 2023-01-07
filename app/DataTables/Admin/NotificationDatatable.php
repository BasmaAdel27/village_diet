<?php

namespace App\DataTables\Admin;

use Illuminate\Notifications\DatabaseNotification;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NotificationDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('title', function ($q) {
                return $q->data['title'] ?? '';
            })
            ->editColumn('created_at', function ($q) {
                return $q->created_at->diffForHumans();
            })
            ->editColumn('Action', function ($query) {
                return view('admin.notifications.datatable.action', compact('query'));
            })->rawColumns(['is_active', 'Active']);
    }

    public function query()
    {
        return DatabaseNotification::select('notifications.*')
            ->join('users', 'users.id', 'notifiable_id')
            ->where('notifiable_type', 'App\Models\User')->latest()->newQuery();
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
                Button::make('export'),
                Button::make('print'),
                Button::make('reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->name('DT_RowIndex')->title(trans('ID'))->orderable(false)->searchable(false),            Column::make('title')->title(trans('title'))->orderable(false)->searchable(false),
            Column::make('type')->title(trans('type')),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }

    protected function filename()
    {
        return 'Admin/NotiifcationDatatables_' . date('YmdHis');
    }
}
