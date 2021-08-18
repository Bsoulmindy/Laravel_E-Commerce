<?php

namespace App\Http\Controllers;

use App\Models\produit;
use App\Models\User;
use App\Traits\save;
use Illuminate\Support\Facades\Auth;

class savedCarts extends Controller
{
    use save;
    
    /**
     * Save the cart to user
     */
    public function saveCart()
    {
        $this->save();

        //Return to cart page with a notification of sucess
        return redirect('panier')->with('status', 'saved');
    }

    /**
     * Overwrite his actual cart with the saved one
     */
    public function get()
    {
        $user = User::find(Auth::user()->id);
        //Check if the user has a saved cart
        if ($user->produitsPanier->count() == 0)
        {
            return redirect('panier')->with('status', 'empty');
        }

        //Erase the temporary cart
        foreach($_COOKIE as $key=>$value)
        {
            if(produit::where('nom', '=', $key)->first() != NULL)
            {
                setcookie($key, "", time() - 3600);
            }
        }

        //Get the saved cart
        foreach($user->produitsPanier as $produitPanier)
        {
            setcookie($produitPanier->nom, $produitPanier->pivot->Nb, 0, "/");
        }

        //Return to cart page with a notification of sucess
        return redirect('panier')->with('status', 'updated');
    }
}
