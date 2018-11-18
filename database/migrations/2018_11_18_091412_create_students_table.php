<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->string('familiya');
            $table->string('imya');
            $table->string('otchestvo');
            $table->integer('year');
            $table->enum('osn_obuch', ['Бюджет','Коммерция']);
            $table->enum('status_student', ['Учится','В Академическом отпуске','Отчислен']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
