<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationsheepsOrderStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::table('order_student', function(Blueprint $table){
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('type')->references('id')->on('type_order');
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
