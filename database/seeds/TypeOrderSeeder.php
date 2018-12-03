<?php

use Illuminate\Database\Seeder;

class TypeOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_order')->insert([
            'name'=>'Зачисление'
        ]);
        DB::table('type_order')->insert([
            'name'=>'Отчисление'
        ]);
        DB::table('type_order')->insert([
            'name'=>'Академический отпуск'
        ]);
        DB::table('type_order')->insert([
            'name'=>'Восстановление'
        ]);
    }
}
