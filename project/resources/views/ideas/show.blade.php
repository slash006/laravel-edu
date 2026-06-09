<x-layout>

    <div class="card bg-neutral p-6">
        <div>
            {{ $idea->description  }}
        </div>
        <div class="mt-2">
            <a class="btn btn-soft" href="/ideas/{{$idea->id}}/edit">Edit</a>
        </div>

{{--        @if($idea?->description)

            {{ $idea->description }}

        @else
            No valid idea found

        @endif--}}

    </div>

</x-layout>
