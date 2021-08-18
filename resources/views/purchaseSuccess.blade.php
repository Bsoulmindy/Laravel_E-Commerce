<x-head/>
    <body>
        <x-header/>
        <main>
            <div class="alert alert-success d-flex align-items-center justify-content-center px-5 mb-0" role="alert">
                <svg id="check-circle-fill" fill="currentColor" class="me-4" width="24" height="24" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"></path>
                </svg>
                <span>Succès d'achat!</span>
            </div>
            <div class="text-center mt-5 mb-2">
                <p class="fs-2 fw-bold">Merci pour votre achat!</p>
            </div>
            <div class="text-center mb-2">
                <p class="fs-5 mb-2 text-gray">Veuillez rappeler votre commande ID en cas de besoin!</p>
                <p class="fs-4">Commande ID : <span class="text-primary fw-bold">{{ $commande_id }}</span></p>
            </div>
        </main>
        <script src={{ asset("js/bootstrap.min.js") }}></script>
        <script src={{ asset("js/bootstrap.bundle.min.js") }}></script>
    </body>
</html>