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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // L'utilisateur qui a ouvert le ticket
            $table->string('sujet');
            $table->enum('priorite', ['basse', 'moyenne', 'haute', 'urgente'])->default('moyenne');
            $table->enum('statut', ['ouvert', 'en_cours', 'resolu', 'ferme'])->default('ouvert');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
