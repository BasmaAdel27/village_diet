<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SocietyDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocietyRequest;
use App\Models\Chat\SocietyChat;
use App\Models\SeenMessage;
use App\Models\Society\Society;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

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
        $users = User::find($data['user_id']);
        $users->map->update(['society_id' => $society->id]);

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
        $senders=SocietyChat::pluck('sender_id')->toArray();
        if ($senders) {
            if (in_array(auth()->id(), $senders)) {
                $sender = SocietyChat::where([['sender_id', auth()->id()], ['society_id', $society->id], ['read_at', null]])->orderBy('id', 'DESC')->first();
                if ($sender) {
                    $unreadMsgs = SocietyChat::where([['id', '>', $sender->id], ['society_id', $society->id]])->get();
                    foreach ($unreadMsgs as $unreadMsg) {
                        SeenMessage::create([
                              'message_id' => $unreadMsg->id,
                              'user_id' => auth()->id(),
                        ]);
                        $sender->read_at = now();
                        $sender->save();
                    }
                }

            } else {
                $Msgs = SocietyChat::where([['society_id', $society->id]])->get();
                $readMsgs = SeenMessage::get();
                foreach ($Msgs as $Msg) {
                    if ($readMsgs->isNotEmpty()) {
                        foreach ($readMsgs as $readMsg) {
                            $data = SeenMessage::where([['message_id', $Msg->id], ['user_id', auth()->id()]])->get();
                            if (!$data)
                                SeenMessage::create([
                                      'message_id' => $Msg->id,
                                      'user_id' => auth()->id(),
                                ]);
                        }
                    } else {
                        SeenMessage::create([
                              'message_id' => $Msg->id,
                              'user_id' => auth()->id(),
                        ]);
                    }
                }
            }
        }
        return view('admin.society.chat',compact('messages','society'));
    }

    public function addMsg(Request $request){
        $data = $request->all(['message']);
        $validator = Validator::make($data, ['message' => 'required']);
        if ($validator->fails())
            return redirect()->back()->with("errors",$validator->errors());

        $message=SocietyChat::create([
              'message'=>$request->message,
              'sender_id'=>auth()->id(),
               'type'=>'TEXT',
                'society_id'=>$request->society_id,
        ]);
        return redirect()->back();

    }

    public function save(Request $request){
        $path = $request->file('message')->storePublicly('chats/media', "public");
        $message=SocietyChat::create([
              'message'=>"/storage/" . $path,
              'sender_id'=>$request->sender,
              'type'=>'AUDIO',
              'society_id'=>$request->society,
        ]);
       return response()->json($message);
    }
}
