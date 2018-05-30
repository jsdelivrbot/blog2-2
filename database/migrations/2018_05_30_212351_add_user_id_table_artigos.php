<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdTableArtigos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artigos', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->default(1);//unsigned: soment inteiros positivos
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');//se deletarmos um usuario então deletaremos todos os artigos referentes a ele automaticamente
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artigos', function (Blueprint $table) {
            //desfazer ao contrario do up ou do último p o primeiro
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
