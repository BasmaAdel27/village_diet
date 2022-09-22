<?php

namespace App\DataTables\Admin;

use App\Models\Society\Society;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SocietyDatatable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('Action', function ($query) {

                return view('admin.society.datatable.action', compact('query'));
            })
            ->editColumn('users_count', function ($query) {
                return  $query->users()->count();
            })
            ->editColumn('trainer.first_name', function ($query) {
                return  $query->trainer?->first_name . ' ' .  $query->trainer?->user?->second_name;
            })
            ->editColumn('is_active', function ($query) {
                return ($query->is_active == 1) ?  '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' .  trans('inactive') . "</span>";
            })->editColumn('translations.title', function ($query) {
                return $query->translate(app()->getLocale())->title;
            })->rawColumns(['Action', 'is_active']);
    }


    public function query()
    {
        return Society::with(['trainer', 'translations'])->withCount('users')->select('societies.*')->newQuery();
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
            Column::make('id')->title(trans('ID')),
            Column::make('translations.title')->orderable(true)->title(trans('society_name'))->orderable(false),
            Column::make('users_count')->orderable(true)->title(trans('users_count'))->orderable(false)->searchable(false),
            Column::make('trainer.first_name')->orderable(true)->title(trans('trainer_name'))->orderable(false),
            Column::make('date from')->orderable(true)->title(trans('date from'))->orderable(false),
            Column::make('is_active')->title(trans('status')),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }


    protected function filename()
    {
        return 'Admin/Society_' . date('YmdHis');
    }
}
