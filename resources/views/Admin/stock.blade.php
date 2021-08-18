<x-head/>
    <body>
        <x-header-admin active="stats du site"/>
        <main>
            <x-panel-options active='{{ $active }}'/>
            <div>
                <div class="text-center my-5">
                    <span class="fs-2">Coût du stock actuel : <span class="text-primary fw-bold">{{ $coutStockTotal }} DH</span></span>
                </div>
                <table class="table table-success table-striped" style="height: 75%;">
                    <thead>
                        <tr>
                          <th scope="col">Catégorie</th>
                          <th scope="col">Coût du stock (DH)</th>
                          <th scope="col">Nb produits</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                        <tr>
                            <th scope="col">{{ ucfirst($type) }}</th>
                            <td>{{ $coutStock[$type] }}</td>
                            <td>{{ $nbStock[$type] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
        <script src={{ asset("js/bootstrap.min.js") }}></script>
        <script src={{ asset("js/bootstrap.bundle.min.js") }}></script>
    </body>
</html>