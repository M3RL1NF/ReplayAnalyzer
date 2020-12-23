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
            $table->foreignId('map_id');
            $table->foreignId('battle_type_id');
            $table->bigInteger('spawn');
            $table->string('result');
            $table->bigInteger('duration');
            $table->timestamp('server_game_time');
            $table->string('patch');
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
