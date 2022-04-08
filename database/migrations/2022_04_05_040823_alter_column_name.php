<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnName extends Migration
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
            $table->renameColumn('auth_id','role_id');
        });
        Schema::table('permission_role', function(Blueprint $table) {
            $table->renameColumn('auth_id','role_id');
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
            $table->renameColumn('role_id','auth_id');
        });
        Schema::table('permission_role', function(Blueprint $table) {
            $table->renameColumn('role_id','auth_id');
        });
    }
}
