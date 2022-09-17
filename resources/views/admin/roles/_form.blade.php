<div class="row">
  <div class="form-group col-6">
    <label>@lang('role')</label>
    <input type="text" class="form-control" name="role_name"
      value="{{ isset($role) ? $role->name : old('role_name') }}" />
  </div>

  <div class="form-group col-12">
    <label>@lang('permissions')</label>
    <select class="js-example-basic-multiple form-control" name="permission[]" multiple="multiple">
      @foreach($permissions as $permission)
      <option value="{{ $permission->id }}" {{ in_array($permission->id,isset($rolePermissions) ? $rolePermissions : [])
        ? 'selected' : '' }}>
        {{ trans('site.' . $permission->name) }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="row">
  <div class="form-group col-6">
    <input type="submit" class="btn btn-dark" value="@lang('submit')">
  </div>
</div>
