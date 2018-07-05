<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5b3da5c120d0cRelationshipsToPlayerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function(Blueprint $table) {
            if (!Schema::hasColumn('players', 'nationality_id')) {
                $table->integer('nationality_id')->unsigned()->nullable();
                $table->foreign('nationality_id', '180854_5b3da549999ed')->references('id')->on('countries')->onDelete('cascade');
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
        Schema::table('players', function(Blueprint $table) {
            if(Schema::hasColumn('players', 'nationality_id')) {
                $table->dropForeign('180854_5b3da549999ed');
                $table->dropIndex('180854_5b3da549999ed');
                $table->dropColumn('nationality_id');
            }
            
        });
    }
}
