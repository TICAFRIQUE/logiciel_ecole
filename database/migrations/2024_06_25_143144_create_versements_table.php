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
        Schema::create('versements', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->double('montant_verse')->default(0)->nullable();
            $table->double('montant_restant')->default(0)->nullable();
            $table->double('montant_scolarite')->default(0)->nullable();
            // $table->integer('remise')->default(0)->nullable();
            // $table->double('montant_remise')->default(0)->nullable();
            // $table->longText('observation')->nullable();


            //foreignId
            $table->foreignId('mode_paiement_id')
                ->nullable()
                ->constrained('mode_paiements')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('motif_paiement_id')
                ->nullable()
                ->constrained('motif_paiements')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->foreignId('inscription_id')
                ->nullable()
                ->constrained('inscriptions')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('versements');
    }
};
