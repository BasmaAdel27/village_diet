@extends('admin.app')
@section('content')
<div class="container">

  <div class="card mt-5">
    <div class="card-header d-flex justify-content-between">
      <h2 class="mb-4">@lang('contact us')</h2>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card-body">
        <div class="table-responsive pt-3">
          <table class="table table-dark" style="width:75%;margin: auto;text-align: center">
            <thead>
              <tr>
                <td colspan="4">@lang('contact us details')</td>
              </tr>
              <tr>
                <td class="col-2">@lang('#')</td>
                <td>{{$contactUs->id}}</td>
              </tr>
              <tr>
                <td class="col-2">@lang('name')</td>
                <td>{{$contactUs->fullname}}</td>
              </tr>
              <tr>
                <td class="col-2">@lang('user type')</td>
                <td>{{$contactUs->user_type}}</td>
              </tr>
              <tr>
                <td class="col-2">@lang('email')</td>
                <td>{{$contactUs->eamil}}</td>
              </tr>
              <tr>
                <td class="col-2">@lang('message type')</td>
                <td>{{$contactUs->message_type}}</td>
              </tr>
              <tr>
                <td class="col-2">@lang('content')</td>
                <td>{{$contactUs->content}}</td>
              </tr>
              <tr>
                <td class="col-2">@lang('phone')</td>
                <td>{{$contactUs->phone}}</td>
              </tr>
              <tr>
                <td class="col-2">@lang('whatsapp phone')</td>
                <td>{{$contactUs->whatsapp_phone}}</td>
              </tr>
              <tr>
                <td class="col-2">@lang('created_at')</td>
                <td>{{$contactUs->created_at}}</td>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
