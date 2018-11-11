<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('name',[
                'ЗИО','ИС','И','КСК','П','ПО','ПД','ПСА','Э','уКС'
            ]); // Буква специальности
            $table->string('year'); // год поступления
            $table->integer('numeric'); // номер группы
            $table->integer('specialty_id');
            $table->integer('department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
