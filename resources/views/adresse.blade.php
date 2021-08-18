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
            </div>
            <form method="POST" action="/achat/storeAdresse" class="needs-validation" novalidate>
                @csrf
                <div class="d-flex flex-row justify-content-center mt-5">
                    <label for="InputAdresse" class="form-label fs-2">Vous devez indiquez votre adresse pour livraison</label>
                </div>
                <div class="d-flex flex-row justify-content-center">
                    <div class="my-2">
                        <input type="text" class="form-control" id="InputAdresse" size="60" name="adresse" required>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-center my-3">
                    <input type="submit" class="btn btn-primary mx-2" value="Suivant">
                </div>
            </form>
        </main>
        <script src={{ asset("js/bootstrap.min.js") }}></script>
        <script src={{ asset("js/bootstrap.bundle.min.js") }}></script>
        <script src={{ asset("js/formValidation.js") }}></script>
    </body>