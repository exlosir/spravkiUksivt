<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateJournalZayavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('status_zayav');
        Schema::create('status_zayav', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });

        Schema::table('journal_zayav', function (Blueprint $table){
            $table->dropColumn('status');
        });

        Schema::table('journal_zayav', function (Blueprint $table){
            $table->integer('status')->unsigned();
            $table->integer('student_id')->unsigned()->nullable()->change();
            $table->text('comment')->nullable()->change();
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
