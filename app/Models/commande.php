<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commande extends Model
{
    use HasFactory;

    /**
     * The products associated to this commande
     */
    public function contient()
    {
        return $this->hasMany(produitAchete::class);
    }

    public function appartient()
    {
        return $this->belongsTo(User::class);
    }
}
