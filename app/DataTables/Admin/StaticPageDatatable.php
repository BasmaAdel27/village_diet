<?php

namespace App\DataTables\Admin;

use App\Models\StaticPage\StaticPage;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StaticPageDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('Action', function ($query) {
                return view('admin.static_pages.datatable.action', compact('query'));
            })
            ->editColumn('is_active', function ($query) {
                return ($query->is_active == 1) ?  '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' .  trans('inactive') . "</span>";
            })
            ->editColumn('is_show_in_app', function ($query) {
                return ($query->is_show_in_app == 1) ?  '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' .  trans('inactive') . "</span>";
            })
            ->editColumn('images.image', function ($query) {
                return "<img src='" . $query->image . "' width=200>";
            })
            ->editColumn('translations.title', function ($query) {
                return $query->translate(app()->getLocale())->title;
            })
            ->rawColumns(['is_active', 'is_show_in_app', 'Action', 'images.image']);
    }

    public function query()
    {
        return StaticPage::select('static_pages.*')->with(['translations', 'images'])->newQuery();
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
            Column::make('is_active')->title(trans('status')),
            Column::make('is_show_in_app')->title(trans('is_show_in_app')),
            Column::make('images.image')->title(trans('image'))->orderable(false)->searchable(false),
            Column::make('translations.title')->title(trans('title'))->orderable(false),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }


    protected function filename()
    {
        return 'Admin/StaticPage_' . date('YmdHis');
    }
}
