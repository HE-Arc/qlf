<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'name' => "premierTest",
            'created_by' => 1,
            'gamesheets_id' => 1,
        ]);
    }
}
