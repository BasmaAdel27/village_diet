<?php

namespace App\DataTables\Admin;

use App\Models\ContactUs;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ContactUsDatatable extends DataTable
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
            ->EditColumn('Action',function ($query){
                return view('admin.contact_us.datatable.action',compact('query'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ContactUsDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ContactUsDatatable $model)
    {
        return ContactUs::select('*')->newQuery();
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
                    ->dom('Bfrtip')
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
              Column::make('fullname')->orderable(true)->title(trans('name')),
              Column::make('user_type')->orderable(true)->title(trans('user type')),
              Column::make('eamil')->orderable(true)->title(trans('email')),
              Column::make('message_type')->orderable(true)->title(trans('message type')),
//              Column::make('phone')->orderable(true)->title(trans('phone')),
//              Column::make('whatsapp_phone')->orderable(true)->title(trans('whatsapp phone')),
              Column::make('created_at')->title(trans('created_at')),
              Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin/ContactUs_' . date('YmdHis');
    }
}
