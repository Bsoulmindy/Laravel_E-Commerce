<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class modifyUserInfos extends Controller
{
    public function carteValide($carte) { // 12345674 un example carte valide
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
    /** 
     * To modify a user its basic infos (name, email...)
    */
    public function modify(Request $request)
    {
        //Validating the inputs
        $validated = $request->validate([
            'name' => 'sometimes|max:255',
            'email' => 'sometimes|nullable|email:rfc,dns|max:255|unique:App\Models\User,email',
            'carteBancaire' => 'sometimes|max:16',
            'adresse' => 'sometimes|max:255',
        ]);

        //Check if carteBancaire is valid with algorithm Luhn key
        if($validated['carteBancaire'] != NULL)
        {
            if(is_numeric($validated['carteBancaire']))
            {
                if(!carteValide(intval($validated['carteBancaire'])))
                {
                    return redirect('profile')->with('status', 'carteNonValide'); 
                }
            }
            else
            {
                return redirect('profile')->with('status', 'carteNonValide');
            }
        }

        //Check what the user want to modify
        if ($validated['name'] == NULL)
            $validated['name'] = Auth::user()->name;
        if ($validated['email'] == NULL)
            $validated['email'] = Auth::user()->email;
        if ($validated['carteBancaire'] == NULL)
            $validated['carteBancaire'] = Auth::user()->carteBancaire;
        if ($validated['adresse'] == NULL)
            $validated['adresse'] = Auth::user()->adresse;
        
        
        //Apply the modifications
        $user = User::find(Auth::user()->id);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->carteBancaire = intval($validated['carteBancaire']);
        $user->adresse = $validated['adresse'];
        $user->save();

        //Return to profile page with a notification of the success
        return redirect('profile')->with('status', 'Profile updated');
    }

    /**
     * To modify the icon of the user
     */
    public function modifyIcon(Request $request)
    {
        //Validating the inputs
        $request->validate([
            'photo' => 'required|image|max:1024', //max 1Mo
        ]);

        //Save the photo to /profiles folder
        $path = $request->photo->store('public/profiles');

        //Get the name of the file
        $array = explode('/', $path);
        $filename = $array[count($array) - 1];

        //Deleting the prouvious image (if its not the default one)
        $previousImage = Auth::user()->icon;
        if($previousImage != "ProfileDefault.png")
        {
            unlink("C:\\Users\\Oussama\\source\\repos\\PHPFramework\\Projet\\storage\\app\\public\\profiles\\".$previousImage);
        }

        //Apply the modifications
        $user = User::find(Auth::user()->id);
        $user->icon = $filename;
        $user->save();

        //Return to profile page
        return redirect('profile')->with('status', 'Profile updated');
    }

    /**
     * To modify the password of the user
     */
    public function modifyPassword(Request $request)
    {
        //Validating the inputs
        $validated = $request->validate([
            'OldPassword' => 'required|max:255|current_password',
            'NewPassword' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        //Apply the modifications
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->NewPassword);
        $user->save();

        //Return to profile page
        return redirect('profile')->with('status', 'Profile updated');
    }
}
