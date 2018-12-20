<?php

use Illuminate\Database\Seeder;

class StudentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_status')->insert([
            'name'=>'Учится'
        ]);
        DB::table('student_status')->insert([
            'name'=>'Отчислен'
        ]);
        DB::table('student_status')->insert([
            'name'=>'В академическом отпуске'
        ]);
    }
}
