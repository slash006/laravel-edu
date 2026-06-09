@props([
    'title' => 'Default title'
])

{{--night--}}
<html data-theme="dracula">
<head>

{{--    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>--}}


    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />


    <title>
        {{$title }} | Laravel demo
    </title>



</head>

<body>

<x-nav></x-nav>
    <main class="max-w-3xl mx-auto mt-6">

        {{--    <h1>Current page: {{$title ?? ""}}</h1>--}}

        {{$slot}}

    </main>



</body>
</html>
