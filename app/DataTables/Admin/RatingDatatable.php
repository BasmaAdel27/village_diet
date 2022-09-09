<?php

namespace App\DataTables\Admin;

use willvincent\Rateable\Rating;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RatingDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('rating', function ($query) {
                $text = '';
                for ($i = 0; $i < $query->rating; $i++) {
                    $text .= '<span title=' . $query->rating . ' style=color:#FFD700>&#9733;</span>';
                }

                return $text;
            })->editColumn('Action', function ($query) {
                return view('admin.ratings.datatable.action', compact('query'));
            })->editColumn('created_at', function ($query) {
                return $query->created_at->format('Y-m-d');
            })
            ->rawColumns(['rating', 'Action']);
    }


    public function query()
    {
        return Rating::select('ratings.*', 'trainers.first_name as trainer_name', 'users.first_name as user_name')
            ->join('users as trainers', 'trainers.id', 'ratings.rateable_id')
            ->where('rateable_type', 'App\Models\User')
            ->join('users as users', 'users.id', 'ratings.user_id')->newQuery();
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
            Column::make('trainer_name')->name('trainers.first_name')->title(trans('trainer_name')),
            Column::make('rating')->title(trans('rating')),
            Column::make('user_name')->name('users.first_name')->title(trans('user_name')),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }

    protected function filename()
    {
        return 'Admin/Rating_' . date('YmdHis');
    }
}
