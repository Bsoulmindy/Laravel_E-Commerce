<x-head/>
    <body>
        <x-header-admin active="gestion des produits"/>
        <main>
            <x-panel-produits active='{{ $active }}'/>
            <div class="text-center my-5">
                <span class="fs-3 text-gray">Vous êtes sûre que vous voulez continuer?</span>
            </div>
            <div class="d-flex flex-row justify-content-center">
                <div class="text-decoration-none text-dark mx-4 mb-3 bg-light-shadow" style='width: 256px;'>
                    <img src={{ asset("storage/produits/".$produit->image) }} alt={{ $produit->nom }} width="256" height="169" class="rounded">
                    <div class="text-center" style='width: 256px;'>
                        {{ ucfirst($produit->nom) }}
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row justify-content-center my-5">
                <a href="/panel/enleverProduits" class="mx-2">
                    <button type="button" class="btn btn-outline-secondary mx-3">Annuler</button>
                </a>
                <div>
                    <form method="POST" action="/panel/enleverProduits">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="nomCherche" value="{{ $produit->nom }}">
                        @csrf
                        <input type="submit" class="btn btn-outline-danger mx-3" value="Supprimer">
                    </form>
                </div>
            </div>
        </main>
        <script src={{ asset("js/bootstrap.min.js") }}></script>
        <script src={{ asset("js/bootstrap.bundle.min.js") }}></script>
    </body>
</html>