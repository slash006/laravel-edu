<x-layout title="Contact title">
    <h3>Contact form here...</h3>

{{--    @dd($tasks)--}}


    @if(count($tasks))
        We have {{count($tasks)}} tasks!

    @endif


    @foreach($tasks as $task)

        <div>
            My task: {{$task}}
        </div>

    @endforeach

    <h3>{{$title ?? ""}}</h3>

    <x-card class="max-w-400">
        card content here...
    </x-card>

</x-layout>
