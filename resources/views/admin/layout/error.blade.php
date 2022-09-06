@if ($errors->has($input))
<span class="help-block">
        <strong style="color: red;background: white;">{{ $errors->first($input) }}</strong>
</span>
@endif