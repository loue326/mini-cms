<header class="site-header">
    <nav class="site-nav" aria-label="Navigation principale">
        <a class="site-brand" href="{{ route('home') }}">Mini-CMS</a>

        <x-nav-link to="home">Accueil</x-nav-link>
        <x-nav-link to="posts.index" match="posts.*">Articles</x-nav-link>
        <x-nav-link to="time">Heure</x-nav-link>
        <x-nav-link to="about">À propos</x-nav-link>

        @can('manage-categories')
            <x-nav-link to="admin.categories.index" match="admin.categories.*">Catégories</x-nav-link>
        @endcan

        <div class="user-menu">
            @auth
                <span class="user-name">{{ auth()->user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="nav-button">Déconnexion</button>
                </form>
            @endauth

            @guest
                <x-nav-link to="login">Connexion</x-nav-link>
                <x-nav-link to="register">Inscription</x-nav-link>
            @endguest
        </div>
    </nav>
</header>
