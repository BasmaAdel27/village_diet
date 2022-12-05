@extends('admin.app')
@section('styles')
@if (app()->getLocale() == 'en')
<link rel="stylesheet" href={{ asset('adminPanel/css/chat.css') }}>
@else
<link rel="stylesheet" href={{ asset('adminPanel/css/chat_ar.css') }}>
@endif
@endsection
@section('content')
<div class="card chat-app">
  <div class="chat">
    <div class="chat-header clearfix">
      <div class="row">
        <div class="col-lg-6">
          <div class="chat-about">
            <h6 class="m-b-0">{{$user->first_name}} {{$user->last_name}}</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="chat-history" id="chat">
      <ul class="m-b-0">
        @foreach($messages as $message)
        @if($message->sender_id != auth()->id())
        <li class="clearfix">
          <div class="message-data text-right">
            <span>{{$message->sender->first_name}}</span>
            <img src="{{$message->sender->image}}" alt="avatar" />
            <div class="message-data-time">{{date('l Y-m-d H:i A', strtotime($message->created_at))}}</div>
          </div>
          <div class="message other-message float-right">
            @if($message->type == 'TEXT')
            {{ $message->message }}
            @else
            <audio controls>
              <source src="{{ $message->message }}">
            </audio>
            @endif
          </div>
        </li>
        @else
        <li class="clearfix">
          <div class="message-data">
            <span class="message-data-time">{{date('l Y-m-d H:i A', strtotime($message->created_at))}}</span>
          </div>
          <div class="message my-message">
            @if($message->type == 'TEXT')
            {{ $message->message }}
            @else
            <audio controls>
              <source src="{{ $message->message }}">
            </audio>
            @endif
          </div>
        </li>
        @endif
        @endforeach
      </ul>
    </div>
    <form action="{{ route('admin.users.send_message',$userId) }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="chat-message clearfix">
        <div class="input-group mb-0">
          <div class="input-group-prepend">
            <button type="submit" class="btn btn-primary" name="submit"><i
                class="mdi mdi-send"></i> </button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
              <i class="mdi mdi-microphone"></i>
            </button>
          </div>
          <input type="text" class="form-control" name="message" style="border: 1px solid gray" />
        </div>
      </div>
    </form>

    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">@lang('voice_message')</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div id="controls" style="margin: 15px;">
              <button id="recordButton" class="btn btn-success"><i class="mdi mdi-play"></i></button>
              <button id="pauseButton" class="btn btn-primary" disabled><i class="mdi mdi-pause"></i></button>
              <button id="stopButton" class="btn btn-danger" disabled><i class="mdi mdi-stop"></i></button>
            </div>
            <h3 id="record" style="margin-left: 15px"></h3>
            <li id="recordingsList" style="margin-left: 15px;list-style-type: none"></li>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="receiver_id" value="{{$userId}}" />
            <input type="hidden" name="sender_id" value="{{auth()->id()}}" />
            <button type="reset" class="btn btn-danger">@lang('close')</button>
            <button type="submit" class="btn btn-success" id="downloadButton" data-dismiss="modal"
              disabled>@lang('send')</button>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('adminPanel/js/userscript.js') }}"></script>
@endsection
