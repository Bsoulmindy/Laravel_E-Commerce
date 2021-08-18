<x-head/>
    <body>
        <x-header/>
        <main>
            <div class="text-center my-2">
                <p class="fs-2">{{ ucfirst($categorie) }}</p>
            </div>
            @if($produits->count() == 0)
                <div class="d-flex flex-row justify-content-center">
                    <div class="alert alert-danger d-flex align-items-center justify-content-center px-5" role="alert">
                        <svg id="exclamation-triangle-fill" class="me-4" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                        </svg>
                        <div>
                            Pas de produits dans ce catégorie!
                        </div>
                    </div>
                </div>
            @else
                <div class="d-flex flex-row justify-content-evenly flex-wrap bd-secondary my-5 mx-4 ">
                    @foreach ($produits as $produit)
                        <div class="text-decoration-none text-dark mx-4 mb-3 bg-light-shadow">
                            <img src={{ asset("storage/produits/".$produit->image) }} alt={{ $produit->nom }} width="256" height="169" class="rounded">
                            <table width="256">
                                <tr>
                                    <td width="25%">Nom</td><td width="5%">:</td><td width="70%" class="text-break">{{ ucfirst($produit->nom) }}</td>
                                </tr>
                                <tr>
                                    <td>Prix</td><td>:</td><td class="text-break">{{ $produit->prix }} DH</td>
                                </tr>
                                <tr>
                                    <td>En stock</td><td>:</td><td class="text-break" id={{ ($produit->nom)."Stock" }}>{{ $produit->nbStock }}</td>
                                </tr>
                            </table>
                            <hr class="dropdown-divider">
                            <p class="text-center my-0">Votre panier</p>
                            <div class="d-flex flex-row justify-content-evenly">
                                <button type="button" class="btn btn-primary btn-sm btnSM" onclick="Decrementer('{{ $produit->nom }}')">-</button>
                                <span class="text-center my-0 nb-products-in-cart" id={{ $produit->nom }}></span>
                                <button type="button" class="btn btn-primary btn-sm btnSM" onclick="Incrementer('{{ $produit->nom }}')">+</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </main>
        <script src={{ asset("js/bootstrap.min.js") }}></script>
        <script src={{ asset("js/selectionProduits.js") }}></script>
        <script src={{ asset("js/bootstrap.bundle.min.js") }}></script>
    </body>
</html>