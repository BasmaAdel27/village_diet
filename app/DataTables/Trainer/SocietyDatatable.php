<?php

namespace App\DataTables\Trainer;

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

                return view('trainer.society.datatable.action', compact('query'));
            })
            ->editColumn('users_count', function ($query) {
                return  $query->users()->count();
            })
            ->editColumn('is_active', function ($query) {
                return ($query->is_active == 1) ?  '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' .  trans('inactive') . "</span>";
            })->editColumn('translations.title', function ($query) {
                return $query->title;
            })->editColumn('messageCount', function ($query) {
                  return ($query->msgCount($query->id) > 0) ?  '<span class="btn btn-danger" style="margin: auto">' . $query->msgCount($query->id) . "</span>" : '<span class="btn btn-success">' .  $query->msgCount($query->id) . "</span>";
              })->rawColumns(['Action', 'is_active','messageCount']);
    }

    public function query()
    {
        return Society::whereHas('trainer', fn ($q) => $q->where('id', auth()->id()))
            ->with(['translations'])
            ->withCount('users')
            ->select('societies.*')
            ->newQuery();
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
            Column::make('is_active')->title(trans('status')),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('messageCount')->title(trans('messageCount'))->searchable(false)->orderable(false),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }

    protected function filename()
    {
        return 'Trainer/Society_' . date('YmdHis');
    }
}
