<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b3da5c109bf8RelationshipsToTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teams', function(Blueprint $table) {
            if (!Schema::hasColumn('teams', 'country_id')) {
                $table->integer('country_id')->unsigned()->nullable();
                $table->foreign('country_id', '180853_5b3da51fbcfb8')->references('id')->on('countries')->onDelete('cascade');
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
        Schema::table('teams', function(Blueprint $table) {
            if(Schema::hasColumn('teams', 'country_id')) {
                $table->dropForeign('180853_5b3da51fbcfb8');
                $table->dropIndex('180853_5b3da51fbcfb8');
                $table->dropColumn('country_id');
            }
            
        });
    }
}
