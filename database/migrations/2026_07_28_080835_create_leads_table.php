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
    Schema::create('leads', function (Blueprint $table) {
        $table->id();
        
        // Relations et Traçabilité
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Agent créateur
        $table->foreignId('team_id')->nullable()->constrained('teams')->nullOnDelete(); // Équipe
        $table->string('product_type')->default('lanterneau'); // Type de produit

        // Données Prospect / Entreprise
        $table->string('statut')->default('Nouveau'); // ex: Nouveau, À rappeler, Validé, Annulé...
        $table->string('raison_sociale');
        $table->string('siret')->nullable();
        $table->string('gerant')->nullable();
        $table->string('telephone');
        $table->string('email')->nullable();
        $table->string('adresse')->nullable();
        $table->string('code_postal')->nullable();
        $table->string('ville')->nullable();

        // Commentaires
        $table->text('agent_comment')->nullable();
        $table->text('confirmation_comment')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
