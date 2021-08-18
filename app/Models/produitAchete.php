<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produitAchete extends Model
{
    use HasFactory;

    protected $table = 'produits_achetes';
    public $timestamps = false;

    public function appartient()
    {
        return $this->belongsTo(commande::class, 'commande_id', 'id');
    }
}
