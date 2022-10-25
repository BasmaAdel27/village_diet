<?php

namespace App\DataTables\Admin;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserChatDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('first_name', function ($query) {
                return "<span> <img src=" . asset($query->image) . ' width=200>' . $query->first_name . ' ' . $query->last_name . '</span>';
            })
            ->editColumn('created_at', function ($query) {
                return $query->lastMessage->created_at;
            })
            ->editColumn('Action', function ($query) {
                return view('admin.users.chat.datatable.action', compact('query'));
            })->rawColumns(['first_name', 'Action']);
    }

    public function query()
    {
        return User::query()->select('users.*')
            ->whereHas('messagesFromUsers')
            ->with(['messagesFromUsers', 'lastMessage'])
            ->newQuery();
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
            Column::make('created_at')->title(trans('last_message_date')),
            Column::make('Action')->title(trans('action'))->searchable(false)->orderable(false)
        ];
    }

    protected function filename()
    {
        return 'Dashboard/UserChat_' . date('YmdHis');
    }
}
