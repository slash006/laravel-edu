<html>
<head>
    <title>Idea app</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground">
    <x-layout.nav />
    <main class="max-w-7xl mx-auto px-6">
        {{ $slot }}
    </main>


{{--    <div x-data="{show: true}">--}}
{{--        <p x-text="greeting"></p>--}}

{{--        <input type="text" x-model="greeting">--}}

{{--        <p x-show="show">Show me</p>--}}

{{--        <input type="checkbox" value="show" x-model="show" />--}}

{{--    </div>--}}

    @session('success')
        <div x-data="{show: true}"
             x-init="setTimeout(() => show = false, 1000)"
             x-show="show"
             x-transition.opacity.duration.300ms
             class="bg-primary px-4 py-3 absolute bottom-4 right-4 rounded-lg">
            {{$value}}
        </div>
    @endsession


</body>
</html>
