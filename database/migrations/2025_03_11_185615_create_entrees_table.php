<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('entrees', function (Blueprint $table) {
            
            $table->integer('numEntree')->primary()->autoIncrement();
            $table->integer('stockEntree');
            // $table->date('dateEntree');
            $table->integer('numProd');
           $table->foreign('numProd')->references('numProd')->on('produits'
           )->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrees');
    }
};
