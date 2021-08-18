<?php

namespace App\Http\Controllers;

use App\Models\produit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class controlIndex extends Controller
{
    public function show($categorie)
    {
        $types = explode(',', config('app.types'));
        foreach($types as $type)
        {
            if($categorie == $type)
            {
                $produits = new Collection;
                foreach(produit::where('categorie', $categorie)->get() as $produit)
                {
                    if($produit->nbStock > 0)
                    {
                        $produits->push($produit);
                    }
                }
                return view('produits', ['produits' => $produits, 'categorie' => $categorie]);
            }
        }
        return view('index'); 
    }

    public function panier()
    {
        $produits = produit::where(function (Builder $query) {
            foreach ($_COOKIE as $key=>$value)
            {
                $query->orWhere('nom', '=', $key);
            }
        })->get();

        return view('panier', ['produits' => $produits]);
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'motCherche' => 'required|max:255',
        ]);

        $produits = produit::where('nom', 'LIKE', '%'.$validated['motCherche'].'%')->get();
        
        return view('produitsCherche')->with(['produits' => $produits, 'motCherche' => $validated['motCherche']]);
    }
}
