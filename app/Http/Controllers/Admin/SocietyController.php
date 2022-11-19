<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SocietyDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocietyRequest;
use App\Models\Chat\SocietyChat;
use App\Models\Society\Society;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        $users->map->update(['society_id' => $society->id]);
        $this->sendNotify($users, $society);

        if ($data['is_active'] == 1) {
            $society->update(['date_from' => now()]);
        }
        $users->map->currentSubscription()->map->update([
            'created_at' => $society->date_from,
            'end_date' =>  Carbon::parse($society->date_from)->addDays(30),
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
        $users = $this->handleChangedUsers($society, $data);

        if ($data['is_active'] == 1 && $society->is_active == 0) {
            $society->update(['date_from' => now()]);
        }

        $users->map->currentSubscription()->map->update([
            'created_at' => $society->date_from,
            'end_date' => Carbon::parse($society->date_from)->addDays(30),
        ]);

        return redirect()->route('admin.societies.index')->with('success', trans('updated_successfully'));
    }


    public function destroy(Society $society)
    {
        $society->delete();

        return redirect()->route('admin.societies.index')->with('success', trans('deleted_successfully'));
    }

    public function messages(Society $society)
    {
        $messages = SocietyChat::with(['society', 'sender'])->where('society_id', $society->id)->orderBy('created_at', 'asc')->get();
        return view('admin.society.chat', compact('messages', 'society'));
    }

    public function addMsg(Request $request)
    {
        $data = $request->all(['message']);
        $validator = Validator::make($data, ['message' => 'required']);
        if ($validator->fails())
            return redirect()->back()->with("errors", $validator->errors());

        $message = SocietyChat::create([
            'message' => $request->message,
            'sender_id' => auth()->id(),
            'type' => 'TEXT',
            'society_id' => $request->society_id,
        ]);
        return redirect()->back();
    }

    public function save(Request $request)
    {
        $path = $request->file('message')->storePublicly('chats/media', "public");
        $message = SocietyChat::create([
            'message' => "/storage/" . $path,
            'sender_id' => $request->sender,
            'type' => 'AUDIO',
            'society_id' => $request->society,
        ]);
        return response()->json($message);
    }

    private function sendNotify($users, $society)
    {
        foreach ($users as $user) {
            $user->notifications()->create([
                'id' => Str::uuid(),
                'type' => 'society',
                'data' => [
                    'title' => 'Society',
                    'title_ar' => 'مجتمعك',
                    'body' => trans('added_to_society', [
                        'trainer' => $society->trainer?->first_name . ' ' . $society->trainer?->first_name,
                    ], 'en'),
                    'body_ar' =>  trans('added_to_society', [
                        'trainer' => $society->trainer?->first_name . ' ' . $society->trainer?->first_name,
                    ], 'ar')
                ]
            ]);
        }

        send_notification($users->pluck('firebase_token')->all(), [
            'type' => 'society',
            'title' => 'Society',
            'title_ar' => 'مجتمعك',
            'body' => trans('added_to_society', [
                'trainer' => $society->trainer?->first_name . ' ' . $society->trainer?->first_name,
            ], 'en'),
            'body_ar' =>  trans('added_to_society', [
                'trainer' => $society->trainer?->first_name . ' ' . $society->trainer?->first_name,
            ], 'ar'),
        ]);
    }

    private function handleChangedUsers($society, $data)
    {
        $oldIds = $society->users()->pluck('id')->all();
        $deletedUsersIds = array_diff($oldIds, $data['user_id']);
        $addedUsersIds = array_diff($data['user_id'], $oldIds);

        User::find($deletedUsersIds)->map->update(['society_id' => null]);
        $users = User::find($data['user_id']);
        $users->map->update(['society_id' => $society->id]);

        if ($deletedUsersIds || $addedUsersIds) {
            $this->sendNotify(User::find($addedUsersIds), $society);
        }

        return $users;
    }
}
