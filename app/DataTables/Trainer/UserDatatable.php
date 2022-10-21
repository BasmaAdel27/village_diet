<?php

namespace App\DataTables\Trainer;

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
            ->editColumn('society', function ($query) {
                return $query->society?->title;
            })
            ->editColumn('currentSubscription.created_at', function ($query) {
                return $query->currentSubscription?->created_at?->diffForHumans();
            })
            ->editColumn('currentSubscription.end_date', function ($query) {
                return $query->currentSubscription?->end_at?->diffForHumans();
            })
            ->editColumn('currentSubscription.status', function ($query) {
                $status = $query->currentSubscription?->status;
                if (!$status) return '';

                return $status == Subscription::ACTIVE ? '<span class="btn btn-success">' . trans('active') . "</span>" : '<span class="btn btn-danger">' .  trans($status) . "</span>";
            })
            ->editColumn('Action', function ($query) {
                return view('trainer.users.datatable.action', compact('query'));
            })->rawColumns(['currentSubscription.status', 'Action']);
    }

    public function query()
    {
        return User::whereHas('roles', fn ($q) => $q->where('name', 'user'))
            ->select('users.*')->with([
                'society' => fn ($q) => $q->where('trainer_id', auth()->id()),
                'currentSubscription'
            ])->newQuery();
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
            Column::make('society')->title(trans('society_name'))->orderable(false)->searchable(false),
            Column::make('currentSubscription.created_at')->title(trans('subscription_date'))->searchable(false),
            Column::make('currentSubscription.end_date')->title(trans('subscription_end_date'))->searchable(false),
            Column::make('currentSubscription.status')->title(trans('subscription_status'))->searchable(false),
            Column::make('created_at')->title(trans('created_at')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }

    protected function filename()
    {
        return 'Trainer/User_' . date('YmdHis');
    }
}
