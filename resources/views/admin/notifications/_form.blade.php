<div class="row">
  <div class="form-group col-6">
    <label>@lang('title')</label>
    <input type="text" class="form-control" name="data[title]" value="{{ old('data.title') }}">
  </div>
  <div class="form-group col-6">
    <label>@lang('type')</label>
    <select name="type" class="form-control">
      <option value="users">@lang('users')</option>
      <option value="trainers">@lang('trainers')</option>
      <option value="all">@lang('all')</option>
    </select>
  </div>
  <div class="form-group col-12">
    <label>@lang('content')</label>
    <textarea name="data[content]" class="form-control" rows="10" name="data.content">{{ old('content') }}</textarea>
  </div>
</div>
<div class="row">
  <div class="form-group col-6">
    <input type="submit" class="btn btn-dark" value="@lang('send')">
  </div>
</div>
