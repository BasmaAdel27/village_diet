<?php

namespace App\DataTables\Admin;

use App\Models\ContactUs;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ContactUsDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->addIndexColumn()
            ->eloquent($query)
            ->editColumn('Action', function ($query) {
                return view('admin.contact_us.datatable.action', compact('query'));
            });
    }


    public function query()
    {
        return ContactUs::select('contact_us.*')->newQuery();
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
        return [
            Column::make('DT_RowIndex')->name('DT_RowIndex')->title(trans('ID'))->orderable(false)->searchable(false),            Column::make('full_name')->title(trans('name')),
            Column::make('email')->title(trans('email')),
            Column::make('user_type')->title(trans('user type')),
            Column::make('message_type')->title(trans('message type')),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }


    protected function filename()
    {
        return 'Admin/ContactUs_' . date('YmdHis');
    }
}
