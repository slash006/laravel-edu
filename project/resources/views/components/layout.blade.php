@props([
    'title' => 'Default title'
])

{{--night--}}
<html data-theme="dracula">
<head>

{{--    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>--}}


    <title>
        {{$title }} | Laravel demo
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body>

<x-nav></x-nav>
    <main class="max-w-3xl mx-auto mt-6">

        {{--    <h1>Current page: {{$title ?? ""}}</h1>--}}

        {{$slot}}

    </main>



</body>
</html>
