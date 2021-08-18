<header class="px-3 bg-dark bg-gradient text-white">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-around">

            <a href={{ url("/") }} class="text-decoration-none text-white mb-0 py-3">
                <p class="text-center fs-2 align-middle mb-0">Matjari.ma</p>
            </a>
            <div class="d-flex flex-row justify-content-start">
                @if ($active == "stats du site")
                <a class="px-3 mx-1 text-decoration-none panel py-4 active" href="/panel/stats">
                @else
                <a class="px-3 mx-1 text-decoration-none panel py-4 nonactive" href="/panel/stats">
                @endif
                    <span class="align-middle">
                        Stats du site
                    </span>
                </a>
                @if ($active == "gestion des produits")
                <a class="px-3 mx-1 text-decoration-none panel py-4 active" href="/panel/gestionProduits">
                @else
                <a class="px-3 mx-1 text-decoration-none panel py-4 nonactive" href="/panel/gestionProduits">
                @endif
                    <span class="align-middle">
                        Gestion des produits
                    </span>
                </a>
            </div>
            <div class="d-flex flex-row justify-content-start align-items-center">
                <div class="dropdown text-end">
                    <a href="#" class="d-block text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src={{ asset("storage/profiles/".Auth::guard('admin')->user()->icon) }} alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href={{ url("/profile") }}>Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href={{ url("/logout") }}>Déconnexion</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>