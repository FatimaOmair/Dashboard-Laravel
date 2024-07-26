@props([
   'type' => 'text','name','value'=>''
])

<input type="{{ $type ?? 'text' }}"
    @class([
        'form-control',
        'is-invalid' => $errors->has($name),
    ])
    value="{{ old($name, $value) }}"
    class="form-control @error('name') is-invalid @enderror"
    name="{{ $name }}"
    {{ $attributes->class([
        'form-control',
        'is-invalid'=>$errors->has($name)
    ]) }}
     value="{{old($name,$value) }}">
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror

