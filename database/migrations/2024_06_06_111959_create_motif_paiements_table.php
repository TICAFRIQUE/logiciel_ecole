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
        Schema::create('motif_paiements', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); //libelle
            $table->string('slug')->nullable();
            $table->string('status')->nullable();
            $table->string('position')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motif_paiements');
    }
};
