<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'Familiya'=>'Нуретдинов',
            'Imya'=>'Тимур',
            'Otchestvo'=>'Азатович',
            'username'=>'Exlosir',
            'password'=>bcrypt('123456')
        ]);
    }
}
