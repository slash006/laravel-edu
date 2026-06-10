<x-layout>

    @if(count($ideas))
        <h3 class="font-bold">Stored ideas</h3>
        <ul class="mt-6 grid grid-cols-2 gap-x-6 gap-y-4">
            @foreach($ideas as $idea)

                <x-idea-card href="/ideas/{{$idea->id}}">
                    {{$idea->description}}
                </x-idea-card>



{{--                <li class="text-sm">{{$idea->description}} <a href="/ideas/{{$idea->id}}">Details</a></li>--}}

            @endforeach
        </ul>

    @else
        <p>No ideas yet</p>
    @endif

    <p class="mt-6">
        <a href="/ideas/create">Create a new one</a>

    </p>

</x-layout>
