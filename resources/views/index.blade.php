<x-head/>
  <body>
    <x-header/>
    <main>
      <div class="d-flex flex-row justify-content-evenly flex-wrap bd-secondary my-5 mx-4">
        <a href="/produits/informatique" class="zoom text-decoration-none text-dark mx-4 mb-3 bg-light-shadow" anim="ripple">
          <div>
            <img src={{ asset("informatique.jpg") }} alt="informatique" width="256" height="169" class="rounded">
            <p class="my-2 text-center">Informatique</p>
          </div>
        </a>
        <a href="/produits/cuisine" class="zoom text-decoration-none text-dark mx-4 mb-3 bg-light-shadow" anim="ripple">
          <div>
            <img src={{ asset("cuisine.jpg") }} alt="cuisine" width="256" height="169" class="rounded">
            <p class="my-2 text-center">Essentiels du cuisine</p>
          </div>
        </a>
        <a href="/produits/telephones" class="zoom text-decoration-none text-dark mx-4 mb-3 bg-light-shadow" anim="ripple">
          <div>
            <img src={{ asset("telephones.jpg") }} alt="telephones" width="256" height="169" class="rounded">
            <p class="my-2 text-center">Télephones & tablettes</p>
          </div>
        </a>
        <a href="/produits/vetements" class="zoom text-decoration-none text-dark mx-4 mb-3 bg-light-shadow" anim="ripple">
          <div>
            <img src={{ asset("vetements.jpg") }} alt="vetements" width="256" height="169" class="rounded">
            <p class="my-2 text-center">Vêtements</p>
          </div>
        </a>
        <a href="/produits/accessoires" class="zoom text-decoration-none text-dark mx-4 mb-3 bg-light-shadow" anim="ripple">
          <div>
            <img src={{ asset("accessoires.jpg") }} alt="accessoires" width="256" height="169" class="rounded">
            <p class="my-2 text-center">Accessoires</p>
          </div>
        </a>
        <a href="/produits/loisirs" class="zoom text-decoration-none text-dark mx-4 mb-3 bg-light-shadow" anim="ripple">
          <div>
            <img src={{ asset("loisirs.png") }} alt="loisirs" width="256" height="169" class="rounded">
            <p class="my-2 text-center">Sport et loisirs</p>
          </div>
        </a>
        <a href="/produits/tvs" class="zoom text-decoration-none text-dark mx-4 mb-3 bg-light-shadow" anim="ripple">
          <div>
            <img src={{ asset("TV.jpg") }} alt="tv" width="256" height="169" class="rounded">
            <p class="my-2 text-center">TVs</p>
          </div>
        </a>
        <a href="/produits/jouets" class="zoom text-decoration-none text-dark mx-4 mb-3 bg-light-shadow" anim="ripple">
          <div>
            <img src={{ asset("jouets.jpg") }} alt="jouets" width="256" height="169" class="rounded">
            <p class="my-2 text-center">Jouets</p>
          </div>
        </a>
        <a href="/produits/nourriture" class="zoom text-decoration-none text-dark mx-4 mb-3 bg-light-shadow" anim="ripple">
          <div>
            <img src={{ asset("nourriture.jpg") }} alt="nourriture" width="256" height="169" class="rounded">
            <p class="my-2 text-center">Nourriture</p>
          </div>
        </a>
        <a href="/produits/electromenagers" class="zoom text-decoration-none text-dark mx-4 mb-3 bg-light-shadow" anim="ripple">
          <div>
            <img src={{ asset("electromenagers.jpg") }} alt="electromenagers" width="256" height="169" class="rounded">
            <p class="my-2 text-center">Électroménagers</p>
          </div>
        </a>
      </div>
    </main>
    <script src={{ asset("js/bootstrap.min.js") }}></script>
    <script src={{ asset("js/ripple.js") }}></script>
    <script src={{ asset("js/bootstrap.bundle.min.js") }}></script>
  </body>
</html>
