<header class="site-header">
    <div class="container nav-links">
        <a href="{{ route('posts.index') }}">Gestion des incidents</a>
        <nav>
            <a href="{{ route('posts.index') }}">Accueil</a>
            @auth
                <a href="{{ route('posts.create') }}" class="button">Créer un signalement</a>
                <a href="{{ route('profile.edit') }}">Profil</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="secondary">Se déconnecter</button>
                </form>
            @else
                <a href="{{ route('login') }}">Connexion</a>
                <a href="{{ route('register') }}">Inscription</a>
            @endauth
        </nav>
    </div>
</header>
