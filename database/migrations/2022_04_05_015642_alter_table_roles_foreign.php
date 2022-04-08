<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableRolesForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('user_role', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('auth_id')->references('id')->on('roles')->onDelete('cascade');
        });

        Schema::table('permission_role', function(Blueprint $table){
            $table->foreign('permission_id')->references('id')->on('permission')->onDelete('cascade');
            $table->foreign('auth_id')->references('id')->on('roles')->onDelete('cascade');
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
        Schema::table('user_role', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('auth_id')->references('id')->on('authorities')->onDelete('cascade');
        });

        Schema::table('permission_role', function(Blueprint $table){
            $table->foreign('permission_id')->references('id')->on('permission')->onDelete('cascade');
            $table->foreign('auth_id')->references('id')->on('authorities')->onDelete('cascade');
        });
    }
}
