<x-head/>
    <body>
        <x-header-admin active="gestion des produits"/>
        <main>
            <x-panel-produits active='{{ $active }}'/>
            <div class="text-center my-5">
                <span class="fs-3 text-gray">Selectionner le produit pour le modifier</span>
            </div>
            <div class="table-responsive my-4">
                <table class="table table-primary table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Nom</th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produits as $produit)
                            <tr>
                                <form method="POST" action="/panel/chercherProduits">
                                    @csrf
                                    <input type="hidden" name="nomCherche" value="{{ $produit->nom }}">
                                    <td><img src={{ asset("storage/produits/".$produit->image) }} alt={{ $produit->nom }} width="256" height="169" class="rounded"></td>
                                    <td class="fs-3">{{ ucfirst($produit->nom) }}</td>
                                    <td><input type="submit" class="btn btn-outline-primary" value="Modifier"></td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
        <script src={{ asset("js/bootstrap.min.js") }}></script>
        <script src={{ asset("js/bootstrap.bundle.min.js") }}></script>
        <script src={{ asset("js/formValidation.js") }}></script>
    </body>
</html>