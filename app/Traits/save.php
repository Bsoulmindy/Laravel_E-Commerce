<?php

namespace App\Traits;

use App\Models\produit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait save {

    public function save()
    {
        $user = User::find(Auth::user()->id);

        //Deleting what is already stored
        $user->produitsPanier()->detach();

        //Saving the new cart to user
        foreach($_COOKIE as $key=>$value)
        {
            $produit = produit::where('nom', '=', $key)->first();

            if($produit == NULL)
            {
                continue;
            }

            $user->produitsPanier()->attach($produit, ['Nb' => intval($value)]);
        }
        
    }
}