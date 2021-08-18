@component('mail::message')
<h1 style="text-align: center;">Résumé de votre commande</h1>

@component('mail::table')
| Nom                   | Prix unitaire | Catégorie | Votre panier |
|:---------------------:|:-------------:|:---------:|:------------:|
@foreach ($produits as $produit)
| {{ ucfirst($produit->nom) }} | {{ $produit->prix }} | {{ ucfirst($produit->categorie) }} | {{ $produit->pivot->Nb }} |
@endforeach
@endcomponent

<p style="text-align: center;">Carte bancaire : <span style="color: #0d6efd;font-weight: 700;">{{ $carteBancaire }}</span></p>

<p style="text-align: center;">Coût total : <span style="color: #0d6efd;font-weight: 700;">{{ $coutTotal }} DH</span></p>

@component('mail::button', ['url' => url("/achat/confirmer/".$token), 'color' => 'primary'])
Confirmer
@endcomponent

@endcomponent
