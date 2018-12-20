<?php

use Illuminate\Database\Seeder;

class OsnovaObucheniyaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student_osnova')->insert([
            'name'=>'Бюджет'
        ]);
        DB::table('student_osnova')->insert([
            'name'=>'Внебюджет'
        ]);
    }
}
