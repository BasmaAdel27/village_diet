<?php

namespace App\DataTables\Admin;

use App\Models\Subscriber;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PostelNewsDatatable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('Action', function ($query) {
                return view('admin.postel_news.datatable.action', compact('query'));
            });
    }


    public function query()
    {
        return Subscriber::select('subscribers.*')->newQuery();
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

            Column::make('DT_RowIndex')->name('DT_RowIndex')->title(trans('ID'))->orderable(false)->searchable(false),            Column::make('email')->title(trans('email')),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false),
        ];
    }

    protected function filename()
    {
        return 'PostelNews_' . date('YmdHis');
    }
}
