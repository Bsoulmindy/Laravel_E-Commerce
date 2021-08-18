<x-head/>
    <body>
        <x-header-admin active="stats du site"/>
        <main>
            <x-panel-options active='{{ $active }}'/>
            <div>
                <div class="text-center my-5">
                    <span class="fs-2">Nombre total des utilisateurs : <span class="text-primary fw-bold">{{ count($users) }}</span></span>
                </div>
                <div class="table-responsive">
                    <table class="table table-primary table-striped">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col"> </th>
                            <th scope="col">Nom d'utilisateur</th>
                            <th scope="col">Email</th>
                            <th scope="col">Carte bancaire</th>
                            <th scope="col">Adresse</th>
                            <th scope="col">Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td><img src={{ asset("storage/profiles/".$user->icon) }} alt="mdo" width="32" height="32" class="rounded-circle"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->carteBancaire }}</td>
                                    <td>{{ $user->adresse }}</td>
                                    <td>{{ $user->isAdmin ? "Oui" : "Non" }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <script src={{ asset("js/bootstrap.min.js") }}></script>
        <script src={{ asset("js/bootstrap.bundle.min.js") }}></script>
    </body>
</html>