<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat\AdminMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function index()
    {
        $adminsIds = User::whereHas('roles', fn ($q) => $q->whereNotIn('name', ['user', 'trainer']))->pluck('id');
        $chats=AdminMessage::where('sender_id','!=',$adminsIds)->get()->groupBy('sender_id');
//        dd($chats);
//        return view('admin.chat',compact('chats'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function message($id)
    {
        $adminId =auth()->id();

        $messages = AdminMessage::with('sender', 'receiver')->where([['sender_id', $id],['receiver_id',$adminId]])
              ->orWhere([['sender_id', $adminId],['receiver_id',$id]])
              ->orderByDesc('created_at')
              ->get();
        dd($messages);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
