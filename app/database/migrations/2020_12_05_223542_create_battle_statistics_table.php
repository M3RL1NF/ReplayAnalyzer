<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBattleStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battle_statistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('map_id')->nullable();
            $table->foreignId('battle_type_id')->nullable();
            $table->string('game_mode')->nullable();
            $table->bigInteger('replay_number');
            $table->integer('spawn')->nullable();
            $table->string('result')->nullable();
            $table->string('duration')->nullable();
            $table->timestamp('server_game_time')->nullable();
            $table->string('patch')->nullable();
            $table->string('region');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('battle_statistics');
    }
}
