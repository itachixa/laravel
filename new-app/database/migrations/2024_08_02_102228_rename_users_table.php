<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUsersTable extends Migration
{
    /**
     * La méthode pour effectuer les modifications de la base de données.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('users', 'user');
    }

    /**
     * La méthode pour annuler les modifications de la base de données.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('users', 'user');
    }
}
