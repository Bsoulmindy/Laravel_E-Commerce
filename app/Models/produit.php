<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class produit extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The products that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function produitsPanier()
    {
        return $this->belongsToMany(User::class, 'paniers', 'produit_id', 'user_id');
    }
}
