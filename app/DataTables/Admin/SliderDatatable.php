<?php

namespace App\DataTables\Admin;

use App\Models\Slider\Slider;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SliderDatatable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('Action', function ($query) {
                return view('admin.sliders.datatable.action', compact('query'));
            })
            ->editColumn('is_active', function ($query) {
                return ($query->is_active == 1) ?  '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' .  trans('inactive') . "</span>";
            })
            ->editColumn('is_show_is_app', function ($query) {
                return ($query->is_show_is_app == 1) ?  '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' .  trans('inactive') . "</span>";
            })
            ->editColumn('translations.title', function ($query) {
                return $query->title;
            })
            ->editColumn('translations.description', function ($query) {
                return $query->description;
            })->rawColumns(['is_active', 'is_show_is_app', 'Action']);
    }


    public function query()
    {
        return Slider::with('translations')->select('sliders.*')->newQuery();
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
            Column::make('link')->title(trans('link')),
            Column::make('is_show_is_app')->title(trans('is_show_is_app')),
            Column::make('translations.title')->title(trans('title'))->orderable(false),
            Column::make('translations.description')->title(trans('description'))->orderable(false),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }


    protected function filename()
    {
        return 'Admin/Slider_' . date('YmdHis');
    }
}
