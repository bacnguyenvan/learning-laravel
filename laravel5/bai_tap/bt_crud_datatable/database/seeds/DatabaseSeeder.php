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
        DB::table('machine')->insert([
            'machine_name' => "Máy A nẫu",
            'id_group' => 1,
           
        ]);
    }
}
