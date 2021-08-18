<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsAchetesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits_achetes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('commande_id');
            $table->bigInteger('produit_id');
            $table->decimal('prixUnitaire', 8, 2, true);
            $table->smallInteger('Nb', false, true); //max : 32767
            $table->decimal('prixAchatMoyen', 8, 2, true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits_achetes');
    }
}
