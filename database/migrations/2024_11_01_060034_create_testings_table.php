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
        Schema::create('testings', function (Blueprint $table) {
            $table->id();
            $table->json('steps'); // Change to JSON
            $table->json('description'); // Change to JSON
            $table->json('images')->nullable(); // Use JSON for multiple images
            $table->string('app'); // Assuming a single app identifier
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testings');
    }
};
