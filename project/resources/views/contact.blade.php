<x-layout title="Contact title">
    <h3>Contact form here...</h3>

    @dump($tasks)

    <h3>{{$title ?? ""}}</h3>

    <x-card class="max-w-400">
        card content here...
    </x-card>

</x-layout>
