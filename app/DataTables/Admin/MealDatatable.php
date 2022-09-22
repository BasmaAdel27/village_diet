<?php

namespace App\DataTables\Admin;

use App\Models\Meal\Meal;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MealDatatable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('translations.breakfast', function ($query) {
                return $query->translate(app()->getLocale())->breakfast;
            })->editColumn('translations.lunch', function ($query) {
                return $query->translate(app()->getLocale())->lunch;
            })->editColumn('translations.dinner', function ($query) {
                return $query->translate(app()->getLocale())->dinner;
            })->editColumn('day.translations.title', function ($query) {
                return $query->day->translate(app()->getLocale())->title;
            })->editColumn('is_active', function ($query) {
                return ($query->is_active == 1) ?  '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' .  trans('inactive') . "</span>";
            })->editColumn('Action', function ($query) {
                return view('admin.meals.datatable.action', compact('query'));
            })->rawColumns(['is_active', 'Active']);
    }


    public function query()
    {
        return Meal::select('meals.*')->with(['translations', 'day.translations'])->newQuery();
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

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title(trans('ID')),
            Column::make('translations.breakfast')->title(trans('breakfast'))->orderable(false),
            Column::make('translations.lunch')->title(trans('lunch'))->orderable(false),
            Column::make('translations.dinner')->title(trans('dinner'))->orderable(false),
            Column::make('day.translations.title')->title(trans('show_day'))->orderable(false),
            Column::make('is_active')->title(trans('status')),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin/Meal_' . date('YmdHis');
    }
}
