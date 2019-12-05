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
            'name' => 'premierTest',
            'created_by' => 1,
            'score' => '{
                            "0": {
                                ["12", "22"]
                            },
                            "1": {
                                ["12", "22"]
                            }
                        }',
            'gamesheets_id' => 1,
        ]);
    }
}
