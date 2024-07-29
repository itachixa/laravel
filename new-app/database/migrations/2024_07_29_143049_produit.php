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
        shema::create ('prduit',function(Blueprint $table)){
            $table->id();
            $table->string('nom');
            $table->string('description');
            $table->float('prix');
            $table->integer('stock');
            $table->timestamps();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
