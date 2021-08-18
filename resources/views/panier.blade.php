<x-head/>
    <body>
        <x-header/>
        <main>
            @if (session('status') == 'saved')
                <div class="alert alert-success d-flex align-items-center justify-content-center px-5 mb-0" role="alert">
                    <svg id="check-circle-fill" fill="currentColor" class="me-4" width="24" height="24" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                    </svg>
                    <span>Votre panier a été enregistré avec succès!</span>
                </div>
            @endif
            @if (session('status') == 'updated')
                <div class="alert alert-success d-flex align-items-center justify-content-center px-5 mb-0" role="alert">
                    <svg id="check-circle-fill" fill="currentColor" class="me-4" width="24" height="24" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                    </svg>
                    <span>Votre panier a été mis à jour avec succès!</span>
                </div>
            @endif
            @if (session('status') == 'empty')
                <div class="alert alert-danger d-flex align-items-center justify-content-center px-5" role="alert">
                    <svg id="exclamation-triangle-fill" class="me-4" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                    </svg>
                    <span>Votre compte n'a pas un panier enregistré!</span>
                </div>
            @endif
            @if (session('status') == 'stockInsuffisant')
                <div class="alert alert-danger d-flex align-items-center justify-content-center px-5" role="alert">
                    <svg id="exclamation-triangle-fill" class="me-4" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                    </svg>
                    <span>Stock insuffisant!</span>
                </div>
            @endif
            <div class="text-center mt-2">
                <p class="fs-2 mb-0">Votre panier</p>
            </div>
            @if ($produits->count() == 0)
                <div class="d-flex flex-row justify-content-center my-5">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center px-5" role="alert">
                        <svg id="exclamation-triangle-fill" class="me-4" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                        </svg>
                        <div>
                            Votre panier est vide!
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center mb-2">
                    <p class="fs-5 mb-1 text-gray">Ce tableau affiche le panier temporaire sauvegardé dans votre navigateur</p>
                </div>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr class="table-dark">
                            <th scope="col" class="table-dark">Nom</th>
                            <th scope="col" class="table-dark">Prix unitaire</th>
                            <th scope="col" class="table-dark">Catégorie</th>
                            <th scope="col" class="table-dark">En stock</th>
                            <th scope="col" class="table-dark">Votre panier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produits as $produit)
                        <tr class="table-dark">
                            <th scope="row" class="table-dark">{{ ucfirst($produit->nom) }}</th>
                            <td class="table-dark" id={{ ($produit->nom)."Prix" }}>{{ $produit->prix }}</td>
                            <td class="table-dark">{{ ucfirst($produit->categorie) }}</td>
                            <td class="table-dark" id={{ ($produit->nom)."Stock" }}>{{ $produit->nbStock }}</td>
                            <td class="table-dark">
                                <button type="button" class="btn btn-primary btn-sm btnSM me-5" onclick="Decrementer('{{ $produit->nom }}')">-</button>
                                <span class="text-center my-0 me-5 nb-products-in-cart" id={{ $produit->nom }}></span>
                                <button type="button" class="btn btn-primary btn-sm btnSM" onclick="Incrementer('{{ $produit->nom }}')">+</button>
                            </td>
                        </tr>    
                        @endforeach
                    </tbody>
                </table>
                <p class="text-center fs-3">
                    Cout tôtal : 
                    <span id="coutTotal" class="text-primary fw-bold price-total"></span>
                    <span class="text-primary fw-bold">
                        DH
                    </span>
                </p>
            @endif
            
            <div class="d-flex flex-row justify-content-center">
                @if (Auth::check() || Auth::guard('admin')->check())
                    <a href={{ url("/enregistrer") }} class="mx-2 my-2">
                        <button type="button" class="btn btn-primary mx-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enregistrer ce panier avec votre compte">
                            Enregistrer
                        </button>
                    </a>
                    <a href={{ url("/recuperer") }} class="mx-2 my-2">
                        <button type="button" class="btn btn-primary mx-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Récupérer le panier depuis ce qui est enregistré dans votre compte">
                            Récupérer
                        </button>
                    </a>
                    <a href={{ url("/achat") }} class="mx-2 my-2">
                        <button type="button" class="btn btn-primary mx-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Passer au procédure d'achat">
                            Acheter
                        </button>
                    </a>
                @else
                    <div class="mx-2 my-2" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Vous n'êtes pas connecté!">
                        <button type="button" class="btn btn-primary" disabled>
                            Enregistrer
                        </button>
                    </div>
                    <div class="mx-2 my-2" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Vous n'êtes pas connecté!">
                        <button type="button" class="btn btn-primary" disabled>
                            Récupérer
                        </button>
                    </div>
                    <div class="mx-2 my-2" tabindex="0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Vous n'êtes pas connecté!">
                        <button type="button" class="btn btn-primary" disabled>
                            Acheter
                        </button>
                    </div>
                @endif
            </div>
        </main>
        <script src={{ asset("js/bootstrap.min.js") }}></script>
        <script src={{ asset("js/bootstrap.bundle.min.js") }}></script>
        <script src={{ asset("js/panier.js") }}></script>
    </body>