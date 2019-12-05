<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

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
            'name' => 'Game1',
            'created_by' => 1,
            'gamesheet_id' => 1,
            'scores' => '{
                "0": ["12", "22"],
                "1": ["12", "22"]
            }',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}