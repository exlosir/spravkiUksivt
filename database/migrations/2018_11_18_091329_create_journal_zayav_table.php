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
            $table->integer('student_id');
            $table->integer('type_id');
            $table->text('Organization');
            $table->enum('status', ['Принята', 'На подписи','Готова','Отклонена']);
            $table->text('comment');
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
