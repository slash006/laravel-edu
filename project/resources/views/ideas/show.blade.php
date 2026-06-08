<x-layout>

{{--    @dump($idea)--}}

    <h1>Idea details</h1>

    <div>

        {{ $idea->description  }}



        <div>

            <a href="/ideas/{{$idea->id}}/edit">Edit</a>
        </div>



{{--        @if($idea?->description)

            {{ $idea->description }}

        @else
            No valid idea found

        @endif--}}

    </div>

</x-layout>
