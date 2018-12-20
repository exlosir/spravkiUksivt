<?php

use Illuminate\Database\Seeder;

class StatusZayavSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_zayav')->insert([
            'name'=>'Принята'
        ]);
        DB::table('status_zayav')->insert([
            'name'=>'Отклонена'
        ]);
        DB::table('status_zayav')->insert([
            'name'=>'На подписи'
        ]);
        DB::table('status_zayav')->insert([
            'name'=>'Готова'
        ]);
    }
}
