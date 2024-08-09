<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // La clé primaire de la session
            $table->unsignedBigInteger('user_id')->nullable(); // Colonne pour stocker l'ID de l'utilisateur associé à la session
            $table->text('payload'); // Colonne pour stocker les données de session
            $table->integer('last_activity'); // Timestamp de la dernière activité
            $table->ipAddress('ip_address')->nullable(); // Colonne pour stocker l'adresse IP de l'utilisateur
            $table->string('user_agent')->nullable(); // Colonne pour stocker l'agent utilisateur (navigateur)
            
            // Vous pouvez ajouter des indices si nécessaire
            // $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
