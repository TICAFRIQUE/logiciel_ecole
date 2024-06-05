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
        Schema::create('niveaux', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable();;
            $table->string('slug')->nullable();;
            $table->double('montant_inscription')->nullable();;
            $table->double('montant_scolarite')->nullable();;
            $table->double('total_scolarite')->nullable();; //montant scolarite + montant inscription
            $table->integer('capacite')->nullable();
            $table->string('status')->nullable();
            $table->string('position')->nullable();

            $table->foreignId('cycle_id')
                ->nullable()
                ->constrained('cycles')
                ->onDelete('cascade');

                
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveaux');
    }
};
