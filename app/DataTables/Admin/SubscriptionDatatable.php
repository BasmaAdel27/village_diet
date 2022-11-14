<?php

namespace App\DataTables\Admin;

use App\Models\Subscription;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubscriptionDatatable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
              ->editColumn('Action', function ($query) {
                  return view('admin.subscriptions.datatable.action', compact('query'));
              })   ->editColumn('user.first_name', function ($query) {
                  return  $query->user->first_name . ' ' .  $query->user->last_name;
              })->editColumn('status', function ($query) {
                  if (app()->getLocale() == 'ar'){
                      return $query->status_ar;
                  }else{
                      if($query->status == 'request_cancel')
                      return trans('cancel_request');
                      else{
                          return $query->status;
                      }

                  }
              })->editColumn('end_date', function ($query) {
                  return  $query->end_date->format('Y-m-d');
              })->rawColumns(['Action','user.first_name','end_date','status']);
    }


    public function query()
    {
        return Subscription::select('subscriptions.*')->with('user')->newQuery();
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
        $data=[
              Column::make('id')->title(trans('ID')),
              Column::make('user.first_name')->title(trans('name'))->orderable(false),
              Column::make('created_at')->title(trans('date-from'))->orderable(true),
              Column::make('end_date')->title(trans('end_date'))->orderable(true),
        ];
        if (app()->getLocale() == 'ar') {

           $data['status_ar']= Column::make('status_ar')->title(trans('status'))->orderable(false);

        }else{
          $data['status']=  Column::make('status')->title(trans('status'))->orderable(false);

        }
        $data['action']=Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false);

        return $data;
    }


    protected function filename()
    {
        return 'Admin/Subscription_' . date('YmdHis');
    }
}
