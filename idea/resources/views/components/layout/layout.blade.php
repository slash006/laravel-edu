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
</body>
</html>
