<?php

namespace App\DataTables\Admin;

use App\Models\Template\Template;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TemplateDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('Action', function ($query) {
                return view('admin.templates.datatable.action', compact('query'));
            })
            ->editColumn('is_active', function ($query) {
                return ($query->is_active == 1) ?  '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' .  trans('inactive') . "</span>";
            })
            ->editColumn('translations.subject', function ($query) {
                return $query->translate(app()->getLocale())->subject;
            })
            ->editColumn('translations.content', function ($query) {
                return $query->translate(app()->getLocale())->content;
            })
            ->rawColumns(['is_active', 'Action']);
    }

    public function query()
    {
        return Template::select('templates.*')->with(['translations'])->newQuery();
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
            Column::make('DT_RowIndex')->name('DT_RowIndex')->title(trans('ID'))->orderable(false)->searchable(false),            Column::make('is_active')->title(trans('status')),
            Column::make('translations.subject')->title(trans('subject'))->orderable(false),
            Column::make('translations.content')->title(trans('content'))->orderable(false),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }

    protected function filename()
    {
        return 'Admin/Template_' . date('YmdHis');
    }
}
