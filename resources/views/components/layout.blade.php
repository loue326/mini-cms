<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Mini-CMS' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="site-body">
    <x-navbar />

    <main class="site-main">
        {{ $slot }}
    </main>

    <footer class="site-footer">
        Mini-CMS - Atelier Framework Côté Serveur - ISET Sidi Bouzid
    </footer>
</body>
</html>