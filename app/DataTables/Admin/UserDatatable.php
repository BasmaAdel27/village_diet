<?php

namespace App\DataTables\Admin;

use App\Models\Subscription;
use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('is_active', function ($query) {
                return ($query->is_active == 1) ?  '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' .  trans('inactive') . "</span>";
            })
            ->editColumn('societies', function ($query) {
                return $query->societies()?->latest()?->first()?->title;
            })
            ->editColumn('subscriptions.created_at', function ($query) {
                return $query->subscriptions()?->latest()?->first()?->created_at?->diffForHumans();
            })
            ->editColumn('subscriptions.status', function ($query) {
                $status = $query->subscriptions()?->latest()?->first()?->status;
                if (!$status) return '';

                return $status == Subscription::ACTIVE ? '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' .  trans($status) . "</span>";
            })
            ->editColumn('Action', function ($query) {
                return view('admin.users.datatable.action', compact('query'));
            })->rawColumns(['subscriptions.status', 'Action']);
    }

    public function query()
    {
        return User::whereHas('roles', fn ($q) => $q->where('name', 'user'))
            ->select('users.*')->with(['societies', 'subscriptions'])->newQuery();
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
            Column::make('first_name')->title(trans('name'))->orderable(false),
            Column::make('user_number')->title(trans('user_number')),
            Column::make('phone')->title(trans('phone')),
            Column::make('societies')->title(trans('society_name'))->orderable(false)->searchable(false),
            Column::make('subscriptions.created_at')->title(trans('subscription_date'))->orderable(false)->searchable(false),
            Column::make('subscriptions.status')->title(trans('subscription_status'))->orderable(false)->searchable(false),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }

    protected function filename()
    {
        return 'Admin/User_' . date('YmdHis');
    }
}
