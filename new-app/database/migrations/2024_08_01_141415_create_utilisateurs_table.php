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
        Schema::create('utilisateurs2', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name field
            $table->string('email')->unique(); // Unique email field
            $table->string('phone')->nullable(); // Phone number field, nullable
            $table->string('password'); // Password field
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
