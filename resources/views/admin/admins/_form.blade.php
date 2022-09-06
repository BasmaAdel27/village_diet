<div class="row">
  <div class="form-group col-6">
    <label>@lang('first_name')</label>
    <input type="text" class="form-control" placeholder="@lang('first_name')" name="first_name"
      value="{{ $admin->first_name ?? old('first_name')}}">
  </div>
  <div class="form-group col-6">
    <label>@lang('last_name')</label>
    <input type="text" class="form-control" placeholder="@lang('last_name')" name="last_name"
      value="{{ $admin->last_name ?? old('last_name')}}">
  </div>
  <div class="form-group col-6">
    <label>@lang('email')</label>
    <input type="text" class="form-control" placeholder="@lang('email')" name="email"
      value="{{ $admin->email ?? old('email')}}">
  </div>
  <div class="form-group col-6">
    <label>@lang('password')</label>
    <input type="password" class="form-control" placeholder="@lang('password')" name="password">
  </div>
  <div class="form-group col-6">
    <label>@lang('password_confirmation')</label>
    <input type="password" class="form-control" placeholder="@lang('password_confirmation')"
      name="password_confirmation">
  </div>
  <div class="form-group col-12">
    <label>@lang('role')</label>
    <select name="role_id" class="form-control">
      <option value="">@lang('select')</option>
      @foreach ($roles as $id => $name)
      <option value="{{ $id }}" {{ isset($admin) && in_array($id,$admin->roles->pluck('id')->toArray()) ? 'selected' :
        '' }}>
        {{ trans($name) }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="row">
  <div class="form-group col-6">
    <input type="submit" class="btn btn-dark" value="@lang('submit')">
  </div>
</div>
