<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b3da5c13b4a1RelationshipsToSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salaries', function(Blueprint $table) {
            if (!Schema::hasColumn('salaries', 'player_id')) {
                $table->integer('player_id')->unsigned()->nullable();
                $table->foreign('player_id', '180856_5b3da5c0749cc')->references('id')->on('players')->onDelete('cascade');
                }
                if (!Schema::hasColumn('salaries', 'team_id')) {
                $table->integer('team_id')->unsigned()->nullable();
                $table->foreign('team_id', '180856_5b3da5c081fa3')->references('id')->on('teams')->onDelete('cascade');
                }
                if (!Schema::hasColumn('salaries', 'season_id')) {
                $table->integer('season_id')->unsigned()->nullable();
                $table->foreign('season_id', '180856_5b3da5c0904b1')->references('id')->on('seasons')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salaries', function(Blueprint $table) {
            if(Schema::hasColumn('salaries', 'player_id')) {
                $table->dropForeign('180856_5b3da5c0749cc');
                $table->dropIndex('180856_5b3da5c0749cc');
                $table->dropColumn('player_id');
            }
            if(Schema::hasColumn('salaries', 'team_id')) {
                $table->dropForeign('180856_5b3da5c081fa3');
                $table->dropIndex('180856_5b3da5c081fa3');
                $table->dropColumn('team_id');
            }
            if(Schema::hasColumn('salaries', 'season_id')) {
                $table->dropForeign('180856_5b3da5c0904b1');
                $table->dropIndex('180856_5b3da5c0904b1');
                $table->dropColumn('season_id');
            }
            
        });
    }
}
