<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('osn_bouch');
            $table->dropColumn('status_student');
            $table->integer('osn_obuch')->unsigned();
            $table->integer('status')->unsigned();
        });

        Schema::table('students', function (Blueprint $table){
            $table->foreign('osn_obuch')->references('id')->on('student_osnova');
            $table->foreign('status')->references('id')->on('student_status');
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
