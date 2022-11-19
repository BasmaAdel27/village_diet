<h2 class="sub-title section-contain">
  {{ $question->content }}
</h2>
@foreach($question->options as $option)
<div class="wrapper mb-1">
  <input type="radio" name="{{ $question->key }}" class="radio-check" value="{{ $option }}" class="radio-check" {{
    $option==old($question->key) ? 'checked' : ''}}>
  <label class="radio-title">
    {{ $option }}
  </label>
</div>
@endforeach
