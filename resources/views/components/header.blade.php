<header class="p-3 bg-dark bg-gradient text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-evenly">

        <a href={{ url("/") }} class="text-decoration-none text-white mb-2">
            <p class="text-center fs-2 align-middle mb-0"> Matjari.ma</p>
        </a>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="POST" action="/search">
            @csrf
            <input type="search" class="form-control form-control-dark" name="motCherche" placeholder="Chercher des produits..." aria-label="Chercher" size=50>
            <input type="submit" style="display: none" />
        </form>

        <div class="d-flex flex-row">
            <a href={{ url("/panier") }} class="text-decoration-none text-white me-4">
                <svg id="cart" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                </svg>
            </a>
            @if (Auth::check() || Auth::guard('admin')->check())
                <div class="dropdown text-end me-4">
                    <a href="#" class="d-block text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        @if(Auth::check())
                            <img src={{ asset("storage/profiles/".Auth::user()->icon) }} alt="mdo" width="32" height="32" class="rounded-circle">
                        @elseif (Auth::guard('admin')->check())
                            <img src={{ asset("storage/profiles/".Auth::guard('admin')->user()->icon) }} alt="mdo" width="32" height="32" class="rounded-circle">
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href={{ url("/profile") }}>Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href={{ url("/logout") }}>Déconnexion</a></li>
                    </ul>
                </div>
                @auth('admin')
                <a href={{ url("/panel") }} class="text-decoration-none text-white me-4">
                    <svg id="panel" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
                    </svg>
                </a>
                @endauth
            @else
            <a href={{ url("/login") }} class="me-2"><button type="button" class="btn btn-outline-light">Connexion</button></a>
            <a href={{ url("/register") }} class="me-2"><button type="button" class="btn btn-warning">S'inscrire</button></a> 
            @endif
        </div>
        </div>
    </div>
</header>