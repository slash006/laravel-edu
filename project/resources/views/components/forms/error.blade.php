{{--@if ($errors->has('description'))--}}
{{--    --}}{{--                    <p class="text-xs text-red-700 my-4">No valid description</p>--}}
{{--    --}}{{--                    <p class="text-xs text-red-700 my-4">{{$errors->first('description')}}</p>--}}
{{--    @foreach($errors->all() as $error)--}}
{{--        <p class="text-xs text-red-700 my-4">{{$error}}</p>--}}
{{--    @endforeach--}}
{{--@endif--}}

@props(
    [
        'name' => 'required'
    ]
)

@error($name)
    <p class="text-xs text-error my-4">{{$message}}</p>
@enderror
