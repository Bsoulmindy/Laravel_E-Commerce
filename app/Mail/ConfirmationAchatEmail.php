<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationAchatEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //This mail needs $produits + $carteBancaire + $token + $coutTotal
        $produits = $this->user->produitsPanier;
        $coutTotal = 0.0;
        foreach($produits as $produit)
        {
            $coutTotal += $produit->prix * $produit->pivot->Nb;
        }
        return $this->markdown('emails.orders.shipped')->with(['produits' => $produits, 'carteBancaire' => $this->user->carteBancaire, 'token' => $this->token, 'coutTotal' => $coutTotal]);
    }
}
