<?php

namespace App\DataTables\Admin;

use App\Models\Trainer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TrainerDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
              ->editColumn('societies_count',function ($query){
                  return $query->societies()->count();
              })
              ->editColumn('show_inPage', function ($query) {
                  return ($query->show_inPage == 1) ? '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' . trans('inactive') . "</span>";
              })
              ->editColumn('statue', function ($query) {
                  return ($query->statue == 'DONE') ? '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' . trans('inactive') . "</span>";
              })->editColumn('Action', function ($query) {
                  return view('admin.trainers.datatable.action', compact('query'));
              })->rawColumns(['societies_count','show_inPage','statue','Active']);    }


    public function query()
    {
        return Trainer::select('trainers.*', 'users.first_name as trainer_name','users.phone as phone')
              ->join('users', 'users.id', 'trainers.user_id')
              ->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
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
            Column::make('trainer_name')->name('users.first_name')->title(trans('name'))->orderable(false),
            Column::make('phone')->name('users.phone')->title(trans('phone'))->orderable(false),
            Column::make('societies_count')->title(trans('societies count')),
            Column::make('show_inPage')->title(trans('our trainer page')),
              Column::make('statue')->title(trans('status')),
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
        return 'Trainer_' . date('YmdHis');
    }
}
