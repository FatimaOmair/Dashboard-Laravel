@props([
    'name','options','checked'=>false
])

@foreach ($options as $value => $text)
<div class="form-check">
    <input class="form-check-input"
    type="radio"
    name="status"
    value="{{ $value }}"
    @checked(old($name, $checked) == $value)>
    <label class="form-check-label">{{ $text }}</label>
</div>
@endforeach

