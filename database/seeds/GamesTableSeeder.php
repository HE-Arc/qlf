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
        if (env('APP_ENV')=='local'){
            DB::table('games')->insert(
                [
                    'name' => 'Game1',
                    'user_id' => 1,
                    'gamesheet_id' => 1,
                    'scores' => '{
                        "0": {
                            "0": 17,
                            "1": 7,
                            "2": 2
                        },
                        "1": {
                            "0": 53,
                            "1": 22,
                            "2": 33
                        },
                        "2": {
                            "0": 22,
                            "1": 101,
                            "2": 102
                        }
                    }',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            );

            DB::table('games')->insert(
                [
                    'name' => 'Game2',
                    'user_id' => 2,
                    'gamesheet_id' => 2,
                    'scores' => '{
                        "0": {
                            "0": 217,
                            "1": 27,
                            "2": 22
                        },
                        "1": {
                            "0": 253,
                            "1": 222,
                            "2": 233
                        },
                        "2": {
                            "0": 222,
                            "1": 2101,
                            "2": 2102
                        }
                    }',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]
            );
        }
    }
}
