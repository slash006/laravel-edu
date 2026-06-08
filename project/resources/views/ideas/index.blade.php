<x-layout>

    @if(count($ideas))
        <h3 class="font-bold">Stored ideas</h3>
        <ul class="mt-6">
            @foreach($ideas as $idea)
                <li class="text-sm">{{$idea->description}} <a href="/ideas/{{$idea->id}}">Details</a></li>

            @endforeach
        </ul>

    @else
        <p>No ideas yet, <a href="/ideas/create">create a new one</a></p>
    @endif

</x-layout>
