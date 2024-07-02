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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('numero_inscription')->unique()->nullable();
            $table->string('type_inscription')->nullable(); //reinscription , inscription
            $table->string('redoublant')->nullable();
            $table->string('affecte')->nullable();
            $table->string('boursier')->nullable();

            $table->string('nom_tuteur')->nullable();
            $table->string('prenoms_tuteur')->nullable();
            $table->string('adresse_tuteur')->nullable();
            $table->string('contact1_tuteur')->nullable();
            $table->string('contact2_tuteur')->nullable();
            $table->string('email_tuteur')->nullable();
            $table->string('profession_tuteur')->nullable();



            //ForeignId
            $table->foreignId('eleve_id')
                ->nullable()
                ->constrained('eleves')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('annee_scolaire_id')
                ->nullable()
                ->constrained('annee_scolaires')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('niveau_id')
                ->nullable()
                ->constrained('niveaux')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('classe_id')
                ->nullable()
                ->constrained('classes')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            //Scolarite
            $table->integer('remise')->nullable();
            $table->double('montant_scolarite')->nullable();
            $table->double('montant_remise_scolarite')->nullable(); //montant apres remise
            $table->double('montant_scolarite_paye')->nullable();
            $table->double('montant_scolarite_restant')->nullable();
            $table->string('statut')->nullable(); //impayé ,  soldé
            $table->longText('observation')->nullable();


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
