@props([
    'title' => 'Default title'
])

<html>
<head>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>


    <title>
        {{$title }} | Laravel demo
    </title>

    <style>

        h1 {

            font-weight: bold;
            font-size: 3rem;
        }

        a {

            text-decoration: underline;
        }

        .max-w-400 {

            max-width: 400px !important;
            margin: auto;
        }

        .card {
/*            border-color: #3e3e3a;
            border-radius: 5px;
            padding: 1rem;
            text-align: center;
            background-color: #cccccc;
            color: #111111;*/
        }

    </style>

</head>

<body class="bg-blue-950 pa-6 max-w-xl mx-auto">



<nav>
    <a href="/">home</a>
    <a href="/about">about</a>
    <a href="/contact">contact us</a>
</nav>
<main>

{{--    <h1>Current page: {{$title ?? ""}}</h1>--}}

    {{$slot}}

</main>
</body>
</html>
