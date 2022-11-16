<?php

namespace App\DataTables\Admin;

use App\Models\Service\Service;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ServiceDatatable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('Action', function ($query) {
                return view('admin.services.datatable.action', compact('query'));
            })
            ->editColumn('is_active', function ($query) {
                return ($query->is_active == 1) ?  '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' .  trans('inactive') . "</span>";
            })
            ->editColumn('translations.title', function ($query) {
                return $query->translate(app()->getLocale())->title;
            })
            ->editColumn('translations.description', function ($query) {
                return $query->translate(app()->getLocale())->description;
            })->rawColumns(['is_active', 'is_show_in_app', 'Action']);
    }


    public function query()
    {
        return Service::with('translations')->select('services.*')->newQuery();
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
            Column::make('translations.title')->title(trans('title'))->orderable(false),
            Column::make('translations.description')->title(trans('description'))->orderable(false),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }


    protected function filename(): string
    {
        return 'Admin/Slider_' . date('YmdHis');
    }
}
