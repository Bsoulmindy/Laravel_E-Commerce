<x-head/>
    <body>
        <x-header-admin active="gestion des produits"/>
        <main>
            <x-panel-produits active='{{ $active }}'/>
            <div class="d-flex flex-row justify-content-center mt-3">
                @if ($errors->any())
                    <div class="alert alert-danger d-flex flex-column align-items-center justify-content-center px-5 mb-0" role="alert">
                        @foreach ($errors->all() as $error)
                        <div class="container">
                            <svg id="exclamation-triangle-fill" class="me-4" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                            </svg>
                            <span>
                                {{ ucfirst($error) }}
                            </span>
                        </div>   
                        @endforeach
                    </div>
                @endif
                @isset ($success)
                    <div class="alert alert-success d-flex align-items-center justify-content-center px-5 mb-0" role="alert">
                        <svg id="check-circle-fill" fill="currentColor" class="me-4" width="24" height="24" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                        </svg>
                        <span>{{ $success }}</span>
                    </div>
                @endisset
            </div>
            <div class="text-center my-5">
                <span class="fs-3 text-gray">Changez uniquement ce que vous voulez!</span>
            </div>
            <form method="POST" action="/panel/modifierProduits" enctype="multipart/form-data">
                @csrf
                <div class="table-responsive my-5">
                    <table class="table table-primary table-striped">
                        <thead>
                            <tr>
                                <th scope="col"><label for="nomInput" class="form-label">Nom</label></th>
                                <th scope="col"><label for="categorieInput" class="form-label">Catégorie</label></th>
                                <th scope="col"><label for="imageInput" class="form-label">Image</label></th>
                                <th scope="col"><label for="prixAchatInput" class="form-label">Prix d'achat du fournisseur</label></th>
                                <th scope="col"><label for="prixInput" class="form-label">Prix de vente aux clients</label></th>
                                <th scope="col"><label for="nbInput" class="form-label">Nb de produits</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control" id="nom" size=20 name="nom" placeholder={{ $produit->nom }}></td>
                                <td>
                                    <select id="categorieInput" class="form-select" aria-label="Catégorie" name="categorie">
                                        @foreach (explode(',',config('app.types')) as $categorie)
                                            <option value="{{ $categorie }}" @if($categorie == $produit->categorie) selected @endif>{{ ucfirst($categorie) }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <img src={{ asset("storage/produits/".$produit->image) }} alt={{ $produit->nom }} width="256" height="169" class="rounded">
                                    <input type="file" class="form-control form-control-sm" id="imageInput" name="image" style="width: 256px;">
                                </td>
                                <td><input type="text" class="form-control" id="prixAchatInput" size=7 name="prixAchat" placeholder={{ $produit->prixAchatMoyen }}></td>
                                <td><input type="text" class="form-control" id="prixInput" size=7 name="prix" placeholder={{ $produit->prix }}></td>
                                <td><input type="text" class="form-control" id="nbInput" size=4 name="nb" placeholder={{ $produit->nbStock }}></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-row justify-content-center my-5">
                    <a href="/panel/modifierProduits" class="mx-2">
                        <button type="button" class="btn btn-outline-secondary mx-3">Rechercher</button>
                    </a>
                    <div>
                        <input type="submit" class="btn btn-outline-primary mx-3" value="Modifier">
                    </div>
                </div>
            </form>
        </main>
        <script src={{ asset("js/bootstrap.min.js") }}></script>
        <script src={{ asset("js/bootstrap.bundle.min.js") }}></script>
    </body>
</html>