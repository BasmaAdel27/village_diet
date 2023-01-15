<div class="col-lg-12 col-12 px-2">
  <div class="form-group span-form">
    <input type="text" class="form-control @error($question->key) is-invalid @enderror"
      placeholder="{{ $question->content }}" name="{{ $question->key }}" value="{{ old($question->key) ?? '' }}" />
    @error($question->key)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
</div>
