<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalSpravoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_spravok', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('zayav_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->date('date');
        });

        Schema::table('journal_zayav', function(Blueprint $table){
            $table->dropForeign(['student_id']);
            $table->dropColumn('student_id');
            $table->string('familiya');
            $table->string('imya');
            $table->string('otchestvo');
            $table->string('year');
            $table->integer('group_id')->unsigned();
        });

        Schema::table('journal_zayav', function(Blueprint $table){
            $table->foreign('group_id')->references('id')->on('groups');
        });

        Schema::table('journal_spravok', function(Blueprint $table){
            $table->foreign('zayav_id')->references('id')->on('journal_zayav');
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal_spravok');
    }
}
