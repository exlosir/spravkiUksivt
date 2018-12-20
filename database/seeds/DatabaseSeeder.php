<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(TypeOrderSeeder::class);
        $this->call(TypeSpravkaSeeder::class);
        $this->call(OsnovaObucheniyaSeeder::class);
        $this->call(StudentStatusSeeder::class);
        $this->call(StatusZayavSeeder::class);
    }
}
