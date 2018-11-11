<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalZayavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_zayavs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identify');
            $table->string('familiya');
            $table->string('imya');
            $table->string('otchestvo');
            $table->integer('year');
            $table->integer('group_id');
            $table->enum('osnova',[
                'Бюджет',
                'Коммерция'
            ]);
            // $table->integer('type_id');
            $table->text('organization');
            $table->text('are');
            $table->enum('status',[
                'Принята',
                'На подписи',
                'Отклонена',
                'Готова'
                ]);
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
        Schema::dropIfExists('journal_zayavs');
    }
}
