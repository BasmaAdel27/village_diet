<?php

namespace App\DataTables\Admin;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('Action', function ($query) {
                return view('admin.admins.datatable.action', compact('query'));
            })
            ->editColumn('role', function ($user) {
                return  $user->roles()->pluck('name')->join(', ');
            });
    }

    public function query()
    {
        return User::select('*')->with('roles')->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
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
            Column::make('id')->title(trans('ID')),
            Column::make('first_name')->orderable(true)->title(trans('first_name')),
            Column::make('last_name')->orderable(true)->title(trans('last_name')),
            Column::make('email')->orderable(true)->title(trans('email')),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('updated_at')->title(trans('updated_at')),
            Column::make('role')->title(trans('role'))->searchable(false)->orderable(false),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }

    protected function filename()
    {
        return 'Admin/Admin_' . date('YmdHis');
    }
}
