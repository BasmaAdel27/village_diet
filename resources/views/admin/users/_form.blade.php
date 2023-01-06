<div class="row">
  <div class="form-group col-6">
    <label>@lang("first_name")</label>
    <input type="text" class="form-control" placeholder='@lang("first_name")' name="first_name"
      value="{{ isset($user) ? $user->first_name : old("first_name")}}">
  </div>
  <div class="form-group col-6">
    <label>@lang("last_name")</label>
    <input type="text" class="form-control" placeholder='@lang("last_name")' name="last_name"
      value="{{ isset($user) ? $user->last_name : old("last_name")}}">
  </div>
  <div class="form-group col-6">
    <label>@lang("email")</label>
    <input type="email" class="form-control" placeholder='@lang("email")' name="email"
      value="{{ isset($user) ? $user->email : old("email")}}">
  </div>
  <div class="form-group col-6">
    <label>@lang("phone")</label>
    <input type="text" class="form-control" placeholder='@lang("phone")' name="phone"
      value="{{ isset($user) ? $user->phone : old("phone")}}">
  </div>
  <div class="form-group col-6">
    <label>@lang("date_of_birth")</label>
    <input type="date" class="form-control" placeholder='@lang("date_of_birth")' name="date_of_birth"
      value="{{ isset($user) ? $user->date_of_birth : old("date_of_birth")}}">
  </div>
  <div class="form-group col-6">
    <label>@lang('countries')</label>
    <select name="country_id" id="country" class="form-control">
      <option value="">@lang('select')</option>
      @foreach ($countries as $id => $name)
      <option value="{{$id}}" {{$id==(isset($user) ? $user->country_id : old('country_id')) ?'selected': '' }}>{{
        trans($name) }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-6">
    <label>@lang("city")</label>
    <input type="text" class="form-control" name='city' value="{{ isset($user) ? $user->city : old('city')}}">
  </div>
  <div class="form-group col-6">
    <label>@lang("address")</label>
    <input type="text" class="form-control" name='address' value="{{ isset($user) ? $user->address : old('address')}}">
  </div>
  <div class="form-group col-6">
    <label>@lang("insta_link")</label>
    <input type="text" class="form-control" name='insta_link'
      value="{{ isset($user) ? $user->insta_link : old('insta_link')}}">
  </div>
  <div class="form-group col-6">
    <label>@lang('subscribe_email')</label>
    <div class="form-check">
      <label class="form-check-label text-muted">
        <input class="form-check-input" type="radio" value="1" name="subscribe">
        @lang('yes')
      </label>
    </div>
    <div class="form-check">
      <label class="form-check-label text-muted">
        <input class="form-check-input" type="radio" value="0" name="subscribe">
        @lang('no')
      </label>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-6">
    <input type="submit" class="btn btn-dark" value="@lang('submit')">
  </div>
</div>
