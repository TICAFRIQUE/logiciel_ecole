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
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('matricule')->unique()->nullable();
            $table->string('numero_extrait')->unique()->nullable();
            $table->string('handicap')->nullable(); // oui ou non
            $table->string('sexe')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenoms')->nullable();
            $table->string('contact')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();


            //foreign Id
            $table->foreignId('groupe_sanguin_id')
                ->nullable()
                ->constrained('groupe_sanguins')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('pays_id')
                ->nullable()
                ->constrained('pays')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('ville_id') //commmune
                ->nullable()
                ->constrained('villes')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->string('quartier')->nullable();
            $table->string('etablissement_origine')->nullable();

            $table->string('nom_pere')->nullable();
            $table->string('prenoms_pere')->nullable();
            $table->string('contact_pere')->nullable();
            $table->string('statut_vivant_pere')->nullable();

            $table->string('nom_mere')->nullable();
            $table->string('prenoms_mere')->nullable();
            $table->string('contact_mere')->nullable();
            $table->string('statut_vivant_mere')->nullable();

            $table->date('date_admission')->nullable();
            $table->date('date_sortie')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves');
    }
};
