<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('user_role', function(Blueprint $table) {

            $table->renameColumn('idUser', 'user_id');
            $table->renameColumn('idAuth','auth_id');
        });
        Schema::table('permission_role', function(Blueprint $table) {
            $table->renameColumn('idPermission', 'permission_id');
            $table->renameColumn('idAuth','auth_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('user_role', function(Blueprint $table) {
            $table->renameColumn('user_id', 'idUser');
            $table->renameColumn('auth_id','idAuth');
        });
        Schema::table('permission_role', function(Blueprint $table) {

            $table->renameColumn('permission_id', 'idPermission');
            $table->renameColumn('auth_id','idAuth');
        });
    }
}
