@extends('admin.app')
@section('title')@lang('settings')@endsection
@section('content')
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">@lang('settings')</h4>
        <form class="form-sample" method="post" action="{{route('admin.settings.update',$settings->id)}}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <p class="card-description">
            @lang('taxes settings')
          </p>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('net subscription')</label>
                <div class="col-sm-8">
                  <input type="text" name="net_subscription" value="{{$settings->net_subscription}}" class="form-control" />
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('tax name')</label>
                <div class="col-sm-8">
                  <input type="text" name="tax_name" value="{{$settings->tax_name}}" class="form-control" />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('tax amount')</label>
                <div class="col-sm-8">
                  <input type="text" name="tax_amount" value="{{$settings->tax_amount}}" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('tax type')</label>
                <div class="col-sm-8">
                  <select class="form-control" name="tax_type">
                    <option value="fixed" {{$settings->tax_type == 'fixed' ? 'selected' : ''}}>@lang('fixed')</option>
                    <option value="percent" {{$settings->tax_type == 'percent' ? 'selected' : ''}}>@lang('percent')</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <p class="card-description">
            @lang('web settings')
          </p>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('web link')</label>
                <div class="col-sm-8">
                  <input type="text" name="website_url" value="{{$settings->website_url}}" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('link status')</label>
                <div class="col-sm-8">
                  <select class="form-control" name="link_status">
                    <option value="1" {{$settings->is_link_active == 1 ? 'selected' : ''}}>@lang('active')</option>
                    <option value="0" {{$settings->is_link_active == 0 ? 'selected' : ''}}>@lang('inactive')</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('web title')</label>
                <div class="col-sm-8">
                  <input type="text" name="website_title" value="{{$settings->web_title}}" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('web description')</label>
                <div class="col-sm-8">
                  <textarea  class="form-control" name="website_description">{{$settings->web_description}}</textarea>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('web logo')</label>

                <div class="col-sm-8">
                  <input type="file" name="logo" class="file-upload-default" value="{{$settings->logo}}" id="image"  >
                  <div class="input-group col-xs-12">
                    <a href="{{asset('storage/'.$settings->logo)}}" target="_blank"><img src="{{asset('storage/'.$settings->logo)}}" id="preview-image" height="100px" width="100px"></a>
                    <input type="text" class="form-control file-upload-info"  disabled placeholder="Upload Image" style="display: none">
                    <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button" >@lang('upload')</button>
                        </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('maintenance')</label>
                <div class="col-sm-8">
                  <select class="form-control" name="web_maintenance">
                    <option value="1" {{$settings->web_maintenance == 1 ? 'selected' : ''}}>@lang('active')</option>
                    <option value="0" {{$settings->web_maintenance == 0 ? 'selected' : ''}}>@lang('inactive')</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <p class="card-description">
            @lang('apps settings')
          </p>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('android forced update')</label>
                <div class="col-sm-8">
                  <select class="form-control" name="forced_android">
                    <option value="1" {{$settings->forced_android == 1 ? 'selected' : ''}}>@lang('active')</option>
                    <option value="0" {{$settings->forced_android == 0 ? 'selected' : ''}}>@lang('inactive')</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('ios forced update')</label>
                <div class="col-sm-8">
                  <select class="form-control" name="forced_ios">
                    <option value="1" {{$settings->forced_ios == 1 ? 'selected' : ''}}>@lang('active')</option>
                    <option value="0" {{$settings->forced_ios == 0 ? 'selected' : ''}}>@lang('inactive')</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('android optional update')</label>
                <div class="col-sm-8">
                  <select class="form-control" name="optional_android">
                    <option value="1" {{$settings->optional_android == 1 ? 'selected' : ''}}>@lang('active')</option>
                    <option value="0" {{$settings->optional_android == 0 ? 'selected' : ''}}>@lang('inactive')</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('ios optional update')</label>
                <div class="col-sm-8">
                  <select class="form-control" name="optional_ios">
                    <option value="1" {{$settings->optional_ios == 1 ? 'selected' : ''}}>@lang('active')</option>
                    <option value="0" {{$settings->optional_ios == 0 ? 'selected' : ''}}>@lang('inactive')</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('android version')</label>
                <div class="col-sm-8">
                  <input type="text" name="android_version" value="{{$settings->android_version}}" class="form-control" />
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('ios version')</label>
                <div class="col-sm-8">
                  <input type="text" name="ios_version" value="{{$settings->ios_version}}" class="form-control" />
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('android maintenance')</label>
                <div class="col-sm-8">
                  <select class="form-control" name="android_maintenance">
                    <option value="1" {{$settings->android_maintenance == 1 ? 'selected' : ''}}>@lang('active')</option>
                    <option value="0" {{$settings->android_maintenance == 0 ? 'selected' : ''}}>@lang('inactive')</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('ios maintenance')</label>
                <div class="col-sm-8">
                  <select class="form-control" name="ios_maintenance">
                    <option value="1" {{$settings->ios_maintenance == 1 ? 'selected' : ''}}>@lang('active')</option>
                    <option value="0" {{$settings->ios_maintenance == 0 ? 'selected' : ''}}>@lang('inactive')</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('footer')</label>
                <div class="col-sm-8">
                  <input type="text" name="footer" value="{{$settings->footer}}" class="form-control" />
                </div>
              </div>
            </div>
          </div>

          <p class="card-description">
            @lang('contact_information')
          </p>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('latitude')</label>
                <div class="col-sm-8">
                 <input type="text" name="latitude" value="{{$settings->latitude}}" class="form-control">
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('longitude')</label>
                <div class="col-sm-8">
                 <input type="text" name="longitude" value="{{$settings->longitude}}" class="form-control">
                </div>
              </div>
            </div>


          </div>
          <div class="row">

            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('address')</label>
                <div class="col-sm-8">
                  <input type="text" name="address" value="{{$settings->address}}" class="form-control">
                </div>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('phone')</label>
                <div class="col-sm-8">
                  <input type="text" name="phone" value="{{$settings->phone}}" class="form-control">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-5">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">@lang('whatsapp_number')</label>
                <div class="col-sm-8">
                  <input type="text" name="whatsapp_number" value="{{$settings->whatsapp_number}}" class="form-control" />
                </div>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-success mb-2" name="submit">@lang('submit')</button>

        </form>
      </div>
    </div>
  </div>
  </div>
@endsection
@section('scripts')
  <script type="text/javascript">
    $('#image').change(function(){
      let reader = new FileReader();
      reader.onload = (e) => {
        $('#preview-image').attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);
    });
  </script>
@endsection
