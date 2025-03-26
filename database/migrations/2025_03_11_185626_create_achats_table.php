<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('achats', function (Blueprint $table) {
            $table->integer('numAchat')->autoIncrement();
            $table->integer('numProd');
            $table->string('nomClient');
            $table->integer('nbrLitre');
            
            $table->primary('numAchat');
            $table->foreign('numProd')->references(
                'numProd'
            )->on('produits')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achats');
    }
};
