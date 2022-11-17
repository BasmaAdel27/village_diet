<?php

namespace App\DataTables\Admin;

use App\Models\Faq\Faq;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FaqsDatatable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
              ->editColumn('translations.question', function ($query) {
                  return $query->translate(app()->getLocale())->question;
              }) ->editColumn('is_active', function ($query) {
                  return ($query->is_active == 1) ?  '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' .  trans('inactive') . "</span>";
              })->editColumn('Action', function ($query) {
                  return view('admin.faqs.datatable.action', compact('query'));
              })->rawColumns(['Action','is_active']);    }

    public function query()
    {
        return Faq::select('faqs.*')->with('translations')->newQuery();
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
              Column::make('translations.question')->title(trans('question'))->orderable(false),
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
        return 'Admin/Faqs_' . date('YmdHis');
    }
}
