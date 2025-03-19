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
        Schema::create('entretiens', function (Blueprint $table) {
            $table->integer('numEntr')->autoIncrement();
            $table->integer('numServ');
            $table->string('numVoiture');
            $table->string('nomClient');
            // $table->date('dateEntretien');
            $table->primary('numEntr');
            $table->foreign('numServ')->references('numServ')->on('services'
            )->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entretiens');
    }
};
