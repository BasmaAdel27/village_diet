<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SocietyDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocietyRequest;
use App\Models\Society\Society;
use App\Models\User;
use Carbon\Carbon;

class SocietyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:admin.societies.index')->only(['index']);
        $this->middleware('permission:admin.societies.store')->only(['store']);
        $this->middleware('permission:admin.societies.update')->only(['update']);
        $this->middleware('permission:admin.societies.destroy')->only(['destroy']);
    }

    public function index(SocietyDatatable $societyDatatable)
    {
        return  $societyDatatable->render('admin.society.index');
    }

    public function create()
    {
        $locales = config('translatable.locales');
        $trainers = User::whereHas('roles', fn ($q) => $q->where('name', 'trainer'))->pluck('first_name', 'id');
        $users = User::doesntHave('society')->whereHas(
            'roles',
            fn ($q) => $q->where('name', 'user')
        )->pluck('first_name', 'id');

        return view('admin.society.create', compact('locales', 'trainers', 'users'));
    }

    public function store(SocietyRequest $request, Society $society)
    {
        $data = $request->validated();
        $society->fill($data)->save();
        $users = User::find($data['user_id']);
        $subscription=$users->map->currentSubscription();
        $users->map->update(['society_id' => $society->id]);

        if ($data['is_active'] == 1) {
            $society->update(['date_from' => now()]);
        }
        $subscription->map->update([
            'created_at' => $society->date_from,
            'end_date' => (new Carbon($society->date_from))->addDays(30),
        ]);

        return redirect()->route('admin.societies.index')->with('success', trans('created_successfully'));
    }

    public function edit(Society $society)
    {
        $locales = config('translatable.locales');
        $trainers = User::whereHas('roles', fn ($q) => $q->where('name', 'trainer'))->pluck('first_name', 'id');
        $users = User::doesntHave('society')->whereHas(
            'roles',
            fn ($q) => $q->where('name', 'user')
        )->orWhereHas('society', fn ($q) => $q->where('society_id', $society->id))->pluck('first_name', 'id');

        return view('admin.society.edit', compact('society', 'locales', 'trainers', 'users'));
    }

    public function update(SocietyRequest $request, Society $society)
    {
        $data = $request->validated();
        $society->fill($data)->save();
        $users = User::find($data['user_id']);
        $subscription=$users->map->currentSubscription();
        $users->map->update(['society_id' => $society->id]);

        if ($data['is_active'] == 1 && $society->is_active == 0) {
            $society->update(['date_from' => now()]);
        }

        $subscription->map->update([
            'created_at' => $society->date_from,
            'end_date' => (new Carbon($society->date_from))->addDays(30),
        ]);

        return redirect()->route('admin.societies.index')->with('success', trans('updated_successfully'));
    }


    public function destroy(Society $society)
    {
        $society->delete();

        return redirect()->route('admin.societies.index')->with('success', trans('deleted_successfully'));
    }
}
