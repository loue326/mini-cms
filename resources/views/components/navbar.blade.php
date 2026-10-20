<header class="site-header">
    <nav class="site-nav" aria-label="Navigation principale">
        <a class="site-brand" href="{{ route('home') }}">Mini-CMS</a>

        <x-nav-link to="home">Accueil</x-nav-link>
        <x-nav-link to="posts.index" match="posts.*">Articles</x-nav-link>
        <x-nav-link to="time">Heure</x-nav-link>
        <x-nav-link to="about">À propos</x-nav-link>
    </nav>
</header>