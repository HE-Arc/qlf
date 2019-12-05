<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('created_by');
            $table->json('scores');
            $table->timestamps();

            //$table->unsignedBigInteger('gamesheet_id');
            //$table->foreign('gamesheet_id')->references('id')->on('gamesheets');
        });

        Schema::table('games', function (Blueprint $table) {
            $table->unsignedBigInteger('gamesheet_id');
            $table->foreign('gamesheet_id')->references('id')->on('gamesheets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
