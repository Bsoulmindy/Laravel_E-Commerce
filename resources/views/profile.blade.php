<x-head/>
    <body>
        <x-header/>
        <main>
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
                @if (session('status') == "Profile updated")
                    <div class="alert alert-success d-flex align-items-center justify-content-center px-5 mb-0" role="alert">
                        <svg id="check-circle-fill" fill="currentColor" class="me-4" width="24" height="24" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                        </svg>
                        <span>Vos informations ont été mis à jour avec succès!</span>
                    </div>
                @endif
                @if (session('status') == "carteNonValide")
                    <div class="alert alert-danger d-flex flex-column align-items-center justify-content-center px-5 mb-0" role="alert">
                        <div class="container">
                            <svg id="exclamation-triangle-fill" class="me-4" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                            </svg>
                            <span>La carte est non valide!</span>
                        </div>
                    </div>
                @endif
            </div>
            <div class="d-flex flex-wrap justify-content-center">
                <div class="mx-2 my-3 bg-light-shadow">
                    <div class="d-flex flex-row justify-content-center my-4">
                        <img src={{ asset("storage/profiles/".Auth::user()->icon) }} alt={{ "profile icon of ".Auth::user()->nom }} class="rounded-circle img-thumbnail" width="128" height="128">
                    </div>
                    <hr class="dropdown-divider">
                    <div class="d-flex flex-row justify-content-center my-2">
                        <label for="InputFile" class="mb-0 fs-5">Modifier l'image</label>
                    </div>
                    <div class="d-flex flex-row justify-content-center my-4">
                        <form method="POST" action="/profile/modifyIcon" class="needs-validation" enctype="multipart/form-data" novalidate>
                            @csrf
                            <input type="file" id="InputFile" name="photo" class="form-control form-control-sm" required>
                            <div class="invalid-feedback">
                                Veuillez sélectionner un fichier!
                            </div>
                            <div class="d-flex flex-row justify-content-center my-4">
                                <input type="submit" class="btn btn-primary" value="Envoyer">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mx-2 my-3 flex-fill">
                    <div class="bg-light-shadow mb-4">
                        <div class="d-flex flex-row justify-content-center">
                            <p class="fs-2 mb-0">Informations du profil</p>
                        </div>
                        <div class="mx-2">
                            <form method="POST" action="/profile/applyModifications">
                                @csrf
                                <div class="mb-3">
                                    <label for="InputNom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="InputNom" name="name" placeholder='{{ Auth::user()->name }}'>
                                </div>
                                <div class="mb-3">
                                    <label for="InputEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="InputEmail" name="email" placeholder={{ Auth::user()->email }}>
                                </div>
                                <div class="mb-3">
                                    <label for="InputcarteBancaire" class="form-label">Carte bancaire</label>
                                    <input type="text" class="form-control" id="InputcarteBancaire" maxlength="16" name="carteBancaire" placeholder={{ Auth::user()->carteBancaire }}>
                                </div>
                                <div class="mb-3">
                                    <label for="InputAdresse" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" id="InputAdresse" name="adresse" placeholder='{{ Auth::user()->adresse }}'>
                                </div>
                                <div class="d-flex flex-row justify-content-center pb-3">
                                    <input type="submit" class="btn btn-primary btn-sm mx-2" value="Appliquer vos modifications">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="bg-light-shadow">
                        <div class="d-flex flex-row justify-content-center">
                            <p class="fs-2 mb-0">Changement du mot de passe</p>
                        </div>
                        <div class="mx-2">
                            <form method="POST" action="/profile/modifyPassword" class="needs-validation" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label for="InputOldPassword" class="form-label">Mot de passe actuel</label>
                                    <input type="password" class="form-control" id="InputOldPassword" name="OldPassword" required>
                                    <div class="invalid-feedback">
                                        Ce champ est obligatoire!
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="InputNewPassword" class="form-label">Nouveau mot de passe</label>
                                    <input type="password" class="form-control" id="InputNewPassword" name="NewPassword" required>
                                    <div class="invalid-feedback">
                                        Ce champ est obligatoire!
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="InputConfirmationPassword" class="form-label">Confirmation du mot de passe</label>
                                    <input type="password" class="form-control" id="InputConfirmationPassword" name="NewPassword_confirmation" required>
                                    <div class="invalid-feedback">
                                        Ce champ est obligatoire!
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-center pb-3">
                                    <input type="submit" class="btn btn-primary btn-sm mx-2" value="Changer le mot de passe">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script src={{ asset("js/bootstrap.min.js") }}></script>
        <script src={{ asset("js/bootstrap.bundle.min.js") }}></script>
        <script src={{ asset("js/formValidation.js") }}></script>
    </body>