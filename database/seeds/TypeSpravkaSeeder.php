<?php

use Illuminate\Database\Seeder;

class TypeSpravkaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_spravka')->insert([
            'name'=>'Неполная справка'
        ]);

        DB::table('type_spravka')->insert([
            'name'=>'Полная справка'
        ]);

        DB::table('type_spravka')->insert([
            'name'=>'Справка в пенсионный фонд'
        ]);
    }
}
