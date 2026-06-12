@props(['name', 'type' => 'text', 'label'])

<div class="space-y-2">
    <label for="{{$name}}" class="label">{{$label}}</label>
    <input type="{{$type}}" name="{{$name}}" id="{{$name}}" class="input" {{$attributes}} />

    @error($name)
        <p class="error text-red-900">{{$message}}</p>
    @enderror

</div>
