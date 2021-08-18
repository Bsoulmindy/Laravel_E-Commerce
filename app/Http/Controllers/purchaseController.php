<?php

namespace App\Http\Controllers;

use App\Mail\confirmationAchatEMail;
use App\Models\commande;
use App\Models\produitAchete;
use App\Models\purchaseRequest;
use App\Models\User;
use App\Traits\save;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

function carteValide($carte) { // 12345674 un example carte valide
    // Méthode Luhn
    // Il retourne un bool : true : carte valide
    //                     : false: carte invalide
  settype($carte, 'string');
  $tab = array(
    array(0,1,2,3,4,5,6,7,8,9),
    array(0,2,4,6,8,1,3,5,7,9));
  $somme = 0;
  $parite = 0;
  for ($i = strlen($carte) - 1; $i >= 0; $i--) {
    $somme += $tab[$parite++ & 1][$carte[$i]];
  }
  return $somme % 10 === 0;
}

class purchaseController extends Controller
{
    use save;
    /**
     * A user want to proceed the purchase
     */
    public function new()
    {
        //Save the current cart to database
        $this->save();

        //Check if the user has already a bank card
        if(Auth::user()->carteBancaire == NULL)
        {
            return redirect('achat/carteBancaire');
        }
        if(Auth::user()->adresse == NULL)
        {
            return redirect('achat/adresse');
        }

        $id = Auth::user()->id;
        $user = User::find($id);
        $token = NULL;



        //Check if the user has a no-empty cart
        if($user->produitsPanier->count() == 0)
        {
            return redirect('panier');
        }

        //Cooldown to prevent the user to purchase again (preventing looping emails which will slow the server SMTP & this site)
        if ($user->requesting == NULL)
        {
            $purchaseRequest = new purchaseRequest;

            $purchaseRequest->user_id = $id;
            $purchaseRequest->commandeToken = Str::random(40);
            $token = $purchaseRequest->commandeToken;
            $purchaseRequest->commandeTime = time();

            $purchaseRequest->save();
        }
        else
        {
            $time = $user->requesting->commandeTime->timestamp;
            $currentTime = time();
            $cooldown = config('app.cooldown');
            if (($currentTime - $time) < intval($cooldown))
            {
                return view('attenteConfirmation')->with('cooldown', $cooldown - $currentTime + $time);
            }
            else
            {
                $purchaseRequest = $user->requesting;

                $purchaseRequest->commandeToken = Str::random(40);
                $token = $purchaseRequest->commandeToken;
                $purchaseRequest->commandeTime = time();

                $purchaseRequest->save();
            }
        }

        //Mail to user mail a confirmation to proceed (mail containing panier, carte bancaire & token)
        Mail::to(Auth::user()->email)->send(new confirmationAchatEMail($user, $token));

        //Return the page indicating he should confirm his email to continue
        return view('attenteConfirmation');
    }

    /**
     * A user want to proceed the purchase but he didnt typed yet his bank card
     */
    public function store(Request $request)
    {
        //Validating the inputs
        $validated = $request->validate([
            'carte_bancaire' => 'required|max:16',
        ]);


        //Check if carte bancaire is valid with algorithm Luhn key
        if($validated['carte_bancaire'] != NULL)
        {
            if(is_numeric($validated['carte_bancaire']))
            {
                if(!carteValide($validated['carte_bancaire']))
                {
                    return redirect('/achat/carteBancaire')->with('status', 'carteNonValide'); 
                }
            }
            else
            {
                return redirect('/achat/carteBancaire')->with('status', 'carteNonValide');
            }
        }

        //Apply the modifications
        $user = User::find(Auth::user()->id);
        $user->carteBancaire = intval($validated['carte_bancaire']);
        $user->save();

        //Proceeding to next pages
        return redirect('achat');
    }

    /**
     * A user want to proceed the purchase but he didnt typed yet his address
     */
    public function storeAdresse(Request $request)
    {
        //Validating the inputs
        $validated = $request->validate([
            'adresse' => 'required|max:255',
        ]);
        
        //Apply the modifications
        $user = User::find(Auth::user()->id);
        $user->adresse = $validated['adresse'];
        $user->save();

        //Proceeding to next pages
        return redirect('achat');
    }

    /**
     * After confirming, the site will take the money from the bank card and deliver to user its products
     */
    public function purchase($token)
    {
        //Validating the token
        if(!is_string($token))
        {
            return view("invalidToken");
        }
        $user = User::find(Auth::user()->id);
        if($user->requesting->commandeToken == NULL)
        {
            return redirect("/");
        }
        if (strcmp($token, $user->requesting->commandeToken) != 0)
        {
            return view("invalidToken");
        }
        
        //Registering the command in historical database table
            //registering new commande
        $commande = new commande;
        $commande->user_id = $user->id;
        $commande->is_delivered = false;
        $commande->save();
        $commande->refresh();
            //Verifying if the stock has enough to purchase
        foreach($user->produitsPanier as $produitPanier)
        {
            if($produitPanier->nbStock < $produitPanier->pivot->Nb)
            {
                return redirect("panier")->with(["status" => "stockInsuffisant"]);
            }
        }

            //Applying the purchase process
        foreach($user->produitsPanier as $produitPanier)
        {
            //To do : bank card
            $produitAchete = new produitAchete;
            $produitAchete->commande_id = $commande->id;
            $produitAchete->produit_id = $produitPanier->id;
            $produitAchete->prixUnitaire = $produitPanier->prix;
            $produitAchete->Nb = $produitPanier->pivot->Nb;
            $produitAchete->prixAchatMoyen = $produitPanier->prixAchatMoyen;

            $produitPanier->nbStock -= $produitPanier->pivot->Nb;

            $produitAchete->save();
            $produitPanier->save();
        }

        //Deleting the token
        $user->requesting->commandeToken = NULL;
        $user->requesting->save();

        //Return to user a page of sucess with the id of command (if a problem occur)
        return view("purchaseSuccess")->with(["commande_id" => $commande->id]);
    }
}
