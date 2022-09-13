<?php

namespace App\DataTables\Admin;

use Spatie\Permission\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RoleDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('Action', function ($query) {
                return view('admin.roles.datatable.action', compact('query'));
            })->rawColumns(['Action']);
    }

    public function query()
    {
        return Role::select('roles.*')->whereNotIn('name', ['admin', 'trainer', 'user'])->newQuery();
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
            Column::make('id')->title(trans('ID')),
            Column::make('name')->title(trans('name')),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }

    protected function filename()
    {
        return 'Admin/Role_' . date('YmdHis');
    }
}
