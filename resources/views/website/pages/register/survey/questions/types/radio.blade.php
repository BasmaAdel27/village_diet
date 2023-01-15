<h2 class="sub-title section-contain">
  {{ $question->content }}
</h2>
@foreach($question->options as $option)
<div class="wrapper mb-1">
  <input type="radio" name="{{ $question->key }}" class="radio-check @error($question->key) is-invalid @enderror"
    value="{{ $option }}" class="radio-check" {{ $option==old($question->key) ? 'checked' : ''}}>
  <label class="radio-title">
    {{ $option }}
  </label>
</div>
@endforeach
@error($question->key)
<span role="alert" style="
    width: 100%;
    margin-top: 0.25rem;
    font-size: 80%;
    color: #dc3545;
    ">
  <strong>{{ $message }}</strong>
</span>
@enderror
