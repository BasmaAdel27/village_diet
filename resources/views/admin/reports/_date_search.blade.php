<form>
  <label for="date_from">@lang('date_from')</label>
  <input type="date" class="form-control" id="date_from" name="date_from"
    value="{{ (request()->date_from) ? date('Y-m-d',strtotime(request('date_from'))): '' }}">
  <label for=" date_to">@lang('date_to')</label>
  <div class="input-group">
    <input type="date" class="form-control" id="date_to" name="date_to"
      value="{{ (request()->date_to) ? date('Y-m-d', strtotime(request('date_to'))): '' }}">
  </div>
  <button type=" submit" class="btn btn-primary mb-2 mt-2">@lang('search')</button>
</form>
