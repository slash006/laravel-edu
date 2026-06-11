<html>
<head>
    <title>Idea app</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground">
    <x-layout.nav />
    <main>
        {{ $slot }}
    </main>
</body>
</html>
