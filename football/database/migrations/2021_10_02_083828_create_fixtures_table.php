<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('week_id');
            $table->unsignedBigInteger('home_team_id');
            $table->unsignedBigInteger('away_team_id');
            $table->tinyInteger('home_goals')->nullable();
            $table->tinyInteger('away_goals')->nullable();
            $table->boolean('played')->default(0);
            $table->timestamps();

            $table->unique(['week_id', 'home_team_id']);
            $table->unique(['week_id', 'away_team_id']);

            $table->foreign('home_team_id')
                ->references('id')
                ->on('teams');


            $table->foreign('away_team_id')
                ->references('id')
                ->on('teams');


            $table->foreign('week_id')
                ->references('id')
                ->on('weeks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
