<?php

namespace App\DataTables\Admin;

use App\Models\CustomerOpinion;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomerOpinionDatatable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
              ->eloquent($query)
              ->editColumn('Action', function ($query) {
                  return view('admin.customer_opinions.datatable.action', compact('query'));
              })->editColumn('images.image', function ($query) {
                  return "<img src='" . $query->image . "' width=200>";
              })->editColumn('content', function ($query) {
                  return "<p style=' white-space: nowrap; width: 100px; overflow: hidden; text-overflow: ellipsis; ' >$query->content</p>";
              })
              ->rawColumns(['Action','content','images.image']);
    }


    public function query()
    {
        return CustomerOpinion::select('customer_opinions.*')->with('images')->newQuery();
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
              Column::make('name')->title(trans('name'))->orderable(false),
              Column::make('images.image')->title(trans('image'))->orderable(false)->searchable(false),
              Column::make('content')->title(trans('content'))->orderable(false)->searchable(false),
              Column::make('created_at')->title(trans('created_at')),
              Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }


    protected function filename()
    {
        return 'Admin/CustomerOpinion_' . date('YmdHis');
    }
}
