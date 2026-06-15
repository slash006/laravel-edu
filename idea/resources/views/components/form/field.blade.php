@props([
    'name',
    'type' => 'text',
    'label' => false]
    )

<div class="space-y-2">

    @if($label)
        <label for="{{$name}}" class="label">{{$label}}</label>
    @endif


    @if($type === 'textarea')
        <textarea
            type="{{$type}}"
            name="{{$name}}"
            id="{{$name}}"

            class="input textarea" {{$attributes}}>{{ old($name) }}</textarea>
    @else

        <input
            type="{{$type}}"
            name="{{$name}}"
            id="{{$name}}"
            value="{{ old($name)  }}"
            class="input" {{$attributes}} />

    @endif


    <x-form.error name="{{$name}}" />


</div>
