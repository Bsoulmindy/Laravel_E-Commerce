<?php

namespace App\Http\Controllers;

use App\Models\produit;
use App\Models\produitAchete;
use App\Models\purchaseRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class panelController extends Controller
{
    public function index()
    {
        return redirect('/panel/stats');
    }

    public function stats()
    {
        //Résultat analytique (total, mois, jour)
        //Nb et cout du stock (actuel)
        //Nb utilisateurs (total)
        return redirect('/panel/resultat');
    }

    public function resultat()
    {
        /*Résultat total
         *Résultat par mois
         *Résultat par jour
         *Affichage correcte des jours et mois précédents (6 strings)
         */
        $resultatTotal = 0.0;
        $resultatMois = array();
        $resultatJour = array();
        for($i=config('app.statsColumn'); $i>=1; $i--)
        {
            $timeMois = Carbon::now()->subMonths($i);
            $resultatMois[$i - 1] = array(0.0, '');
            $resultatJour[$i - 1] = array(0.0, '');
            switch($timeMois->month)
            {
                case 1: $resultatMois[$i - 1][1] = 'Janvier';break;
                case 2: $resultatMois[$i - 1][1] = 'Février';break;
                case 3: $resultatMois[$i - 1][1] = 'Mars';break;
                case 4: $resultatMois[$i - 1][1] = 'Avril';break;
                case 5: $resultatMois[$i - 1][1] = 'Mai';break;
                case 6: $resultatMois[$i - 1][1] = 'Juin';break;
                case 7: $resultatMois[$i - 1][1] = 'Juillet';break;
                case 8: $resultatMois[$i - 1][1] = 'Août';break;
                case 9: $resultatMois[$i - 1][1] = 'Septembre';break;
                case 10: $resultatMois[$i - 1][1] = 'Octobre';break;
                case 11: $resultatMois[$i - 1][1] = 'Novembre';break;
                case 12: $resultatMois[$i - 1][1] = 'Décembre';break;
            }
            $timeJour = Carbon::now()->subDays($i);
            switch($timeJour->month)
            {
                case 1: $resultatJour[$i - 1][1] = 'Janvier';break;
                case 2: $resultatJour[$i - 1][1] = 'Février';break;
                case 3: $resultatJour[$i - 1][1] = 'Mars';break;
                case 4: $resultatJour[$i - 1][1] = 'Avril';break;
                case 5: $resultatJour[$i - 1][1] = 'Mai';break;
                case 6: $resultatJour[$i - 1][1] = 'Juin';break;
                case 7: $resultatJour[$i - 1][1] = 'Juillet';break;
                case 8: $resultatJour[$i - 1][1] = 'Août';break;
                case 9: $resultatJour[$i - 1][1] = 'Septembre';break;
                case 10: $resultatJour[$i - 1][1] = 'Octobre';break;
                case 11: $resultatJour[$i - 1][1] = 'Novembre';break;
                case 12: $resultatJour[$i - 1][1] = 'Décembre';break;
            }
            $resultatJour[$i - 1][1] = strval($timeJour->day)." ".$resultatJour[$i - 1][1];
        }
        produitAchete::chunk(100, function ($produitsAchetes) use (&$resultatTotal, &$resultatMois, &$resultatJour) {
            foreach($produitsAchetes as $produitAchete)
            {
                //Résultat Total
                $resultatTotal += ($produitAchete->prixUnitaire - $produitAchete->prixAchatMoyen) * $produitAchete->Nb;
                $commandeTime = $produitAchete->appartient->updated_at;
                if($commandeTime == NULL)
                {
                    continue;
                }
                for($i=config('app.statsColumn'); $i>=1; $i--)
                {
                    //Résultat des mois précédents
                    $timeMois = Carbon::now()->subMonths($i);
                    if($commandeTime->month == $timeMois->month && $commandeTime->year == $timeMois->year)
                    {
                        $resultatMois[$i - 1][0] += ($produitAchete->prixUnitaire - $produitAchete->prixAchatMoyen) * $produitAchete->Nb;
                    }
                    //Résultat des jours précédents
                    $timeJour = Carbon::now()->subDays($i);
                    if($commandeTime->day == $timeJour->day && $commandeTime->month == $timeJour->month && $commandeTime->year == $timeJour->year)
                    {
                        $resultatJour[$i - 1][0] += ($produitAchete->prixUnitaire - $produitAchete->prixAchatMoyen) * $produitAchete->Nb;
                    }
                }
            }
        });
        
        return view('Admin.resultat')->with(['active' => 'resultat', 'resultatTotal' => $resultatTotal, 'resultatMois' => $resultatMois, 'resultatJour' => $resultatJour]);
    }

    public function stock()
    {
        /**
         * Coût de stock total
         * Par catégorie: Cout de stock + Nb de produits
         */
        $produits = produit::all();
        $coutStockTotal = 0.0;
        $coutStock = array();
        $nbStock = array();
        $types = explode(',', config('app.types'));
        foreach($types as $type)
        {
            $coutStock[$type] = 0.0;
            $nbStock[$type] = 0;
        }
        foreach($produits as $produit)
        {
            $coutStockTotal += $produit->prixAchatMoyen * $produit->nbStock;
            foreach($types as $type)
            {
                if($produit->categorie == $type)
                {
                    $coutStock[$type] += $produit->prixAchatMoyen * $produit->nbStock;
                    $nbStock[$type] += $produit->nbStock;
                    break;
                }
            }
        }
        return view('Admin.stock')->with(['active' => 'stock', 'coutStockTotal' => $coutStockTotal, 'coutStock' => $coutStock,'nbStock' => $nbStock, 'types' => $types]);
    }

    public function utilisateurs()
    {
        //All infos about users
        $users = User::all();
        return view('Admin.users')->with(['active' => 'utilisateurs', 'users' => $users]);
    }

    public function gestionProduits()
    {
        /**
         * Ajouter des produits
         * Modifier des produits
         * Enlever des produits
         */
        return redirect('/panel/ajouterProduits');
    }

    public function ajouterProduitsPage()
    {
        return view("admin.ajouterProduits")->with(['active' => 'ajouterProduits']);
    }

    public function ajouterProduits(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|max:255',
            'categorie' => 'required|max:255',
            'image' => 'sometimes|nullable|image',
            'prixAchat' => 'required|max:100000000|numeric',
            'prix' => 'sometimes|nullable|max:100000000|numeric',
            'nb' => 'required|max:65535|integer',
        ]);
        $types = explode(',',config('app.types'));
        $verified = false;
        foreach($types as $type)
        {
            if($type == $validated['categorie'])
            {
                $verified = true;
                break;
            }
        }
        if(!$verified)
        {
            return redirect('/panel/ajouterProduits')->with(['error' => 'Catégorie incorrecte!']);
        }
        $produit = produit::where('nom', '=', $validated['nom'])->first();
        //Nouveau produit
        if($produit == NULL)
        {
            if(empty($validated['prix']))
            {
                return redirect('/panel/ajouterProduits')->with(['error' => 'Vous devez spécifier un prix pour ce produit!']);
            }
            if(empty($validated['image']))
            {
                return redirect('/panel/ajouterProduits')->with(['error' => 'Vous devez spécifier une image pour ce produit!']);
            }
            //Save the image to /produits folder
            $path = $request->image->store('public/produits');

            //Get the name of the file
            $array = explode('/', $path);
            $filename = $array[count($array) - 1];


            $produit = new produit;
            $produit->nom = $validated['nom'];
            $produit->prix = $validated['prix'];
            $produit->categorie = $validated['categorie'];
            $produit->nbStock = $validated['nb'];
            $produit->image = $filename;
            $produit->prixAchatMoyen = $validated['prixAchat'];
        }
        else
        {
            $produit->prixAchatMoyen = ($validated['prixAchat'] * $validated['nb'] + $produit->prixAchatMoyen * $produit->nbStock)/($produit->nbStock + $validated['nb']);
            if(!empty($validated['prix']))
            {
                $produit->prix = $validated['prix'];
            }
            if(!empty($validated['prix']))
            {
                //Save the image to /produits folder
                $path = $request->image->store('public/produits');

                //Get the name of the file
                $array = explode('/', $path);
                $filename = $array[count($array) - 1];

                $produit->image = $filename;
            }
            $produit->categorie = $validated['categorie'];
            $produit->nbStock += $validated['nb'];
        }

        $produit->save();
        return redirect('/panel/ajouterProduits')->with(['success' => 'Votre produit a été ajouté avec succès']);
    }

    public function modifierProduitsPage()
    {
        $produits = produit::all();
        return view("Admin.chercherProduits")->with(['active' => 'modifierProduits', 'produits' => $produits]);
    }

    public function chercherProduitsPage(Request $request)
    {
        $validated = $request->validate([
            'nomCherche' => 'required|max:255',
        ]);
        $produit = produit::where('nom', '=', $validated['nomCherche'])->first();
        $request->session()->put('produitID', $produit->id);

        return view("Admin.modifierProduits")->with(['active' => 'modifierProduits', 'produit' => $produit]);
    }

    public function chercherProduitsGET(Request $request)
    {
        $id = $request->session()->get('produitID');
        if($id == NULL)
        {
            return redirect('/panel/modifierProduits');
        }
        $produit = produit::find($id);

        return view("Admin.modifierProduits")->with(['active' => 'modifierProduits', 'produit' => $produit]);
    }

    public function modifierProduits(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|nullable|unique:App\Models\produit|max:255',
            'categorie' => 'sometimes|nullable|max:255',
            'image' => 'sometimes|nullable|image',
            'prixAchat' => 'sometimes|nullable|max:100000000|numeric',
            'prix' => 'sometimes|nullable|max:100000000|numeric',
            'nb' => 'sometimes|nullable|max:65535|integer',
        ]);

        $id = $request->session()->get('produitID');
        if($id == NULL)
        {
            return redirect('/panel/modifierProduits');
        }
        $produit = produit::find($id);
        if ($produit == NULL)
        {
            return redirect('/panel/modifierProduits');
        }

        if($validated['nom'] != NULL)
        {
            $produit->nom = $validated['nom'];
        }
        if($validated['categorie'] != NULL)
        {
            $produit->categorie = $validated['categorie'];
        }
        if($validated['prixAchat'] != NULL)
        {
            $produit->prixAchatMoyen = $validated['prixAchat'];
        }
        if($validated['prix'] != NULL)
        {
            $produit->prix = $validated['prix'];
        }
        if($validated['nb'] != NULL)
        {
            $produit->nbStock = $validated['nb'];
        }
        if(isset($validated['image']))
        {
            //Save the image to /produits folder
            $path = $request->image->store('public/produits');

            //Get the name of the file
            $array = explode('/', $path);
            $filename = $array[count($array) - 1];

            //Delete the previous image
            $previousImage = $produit->image;
            unlink("C:\\Users\\Oussama\\source\\repos\\PHPFramework\\Projet\\storage\\app\\public\\produits\\".$previousImage);

            $produit->image = $filename;
        }
        
        $produit->save();

        return view("Admin.modifierProduits")->with(['active' => 'modifierProduits', 'produit' => $produit, 'success' => 'Votre produit a été modifié avec succès']);
    }

    public function enleverProduitsPage()
    {
        $produits = produit::all();
        return view("Admin.enleverProduits")->with(['active' => 'enleverProduits', 'produits' => $produits]);
    }

    public function enleverProduitsVerification(Request $request)
    {
        $validated = $request->validate([
            'nomCherche' => 'required|max:255',
        ]);

        $produit = produit::where('nom', '=', $validated['nomCherche'])->first();
        return view("Admin.enleverProduitsVerification")->with(['active' => 'enleverProduits', 'produit' => $produit]);
    }

    public function enleverProduits(Request $request)
    {
        $validated = $request->validate([
            'nomCherche' => 'required|max:255',
        ]);

        $produit = produit::where('nom', '=', $validated['nomCherche'])->first();
        $produit->delete();

        return redirect('/panel/enleverProduits')->with(['success' => 'Le produit a été supprimé!']);
    }
}
