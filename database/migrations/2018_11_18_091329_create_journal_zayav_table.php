<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalZayavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_zayav', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identify');
            $table->string('familiya');
            $table->string('imya');
            $table->string('otchestvo');
            $table->string('year');
            $table->integer('group_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->text('Organization');
            $table->integer('status')->unsigned();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('journal_zayav');
    }
}
