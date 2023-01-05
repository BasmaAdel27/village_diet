<?php

namespace App\DataTables\Admin;

use App\Models\Country\Country;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CountryDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
              ->eloquent($query)
              ->addIndexColumn()
              ->editColumn('Action', function ($query) {
                  return view('admin.countries.datatable.action', compact('query'));
              }) ->editColumn('translations.name', function ($query) {
                  return $query->translate(app()->getLocale())->name;
              })->rawColumns(['DT_Row_Index','Action']);


    }


    public function query()
    {
        return Country::select('countries.*')->with('translations')->newQuery();
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
              Column::make('DT_RowIndex')->name('DT_RowIndex')->title(trans('ID'))->orderable(false)->searchable(false),

              Column::make('translations.name')->orderable(true)->title(trans('country_name')),

              Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }


    protected function filename()
    {
        return 'Admin/Country_' . date('YmdHis');
    }
}
