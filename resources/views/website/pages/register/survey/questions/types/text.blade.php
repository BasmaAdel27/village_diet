<div class="col-lg-12 col-12 px-2">
  <div class="form-group span-form">
    <input type="text" class="form-control" placeholder="{{ $question->content }}" name="{{ $question->key }}"
      value="{{ old($question->key) ?? '' }}" />
  </div>
</div>
