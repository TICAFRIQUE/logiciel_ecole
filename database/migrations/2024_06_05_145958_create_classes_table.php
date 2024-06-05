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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable();;
            $table->string('slug')->nullable();;
            $table->integer('capacite_min')->nullable();
            $table->integer('capacite_max')->nullable();
            $table->string('status')->nullable();
            $table->string('position')->nullable();

            $table->foreignId('niveau_id')
                ->nullable()
                ->constrained('niveaux')
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
        Schema::dropIfExists('classes');
    }
};
