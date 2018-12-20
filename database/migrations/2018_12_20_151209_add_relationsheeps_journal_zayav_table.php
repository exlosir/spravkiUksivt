<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationsheepsJournalZayavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('journal_zayav', function(Blueprint $table){
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('type_id')->references('id')->on('type_spravka');
            $table->foreign('status')->references('id')->on('status_zayav');
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
    }
}
