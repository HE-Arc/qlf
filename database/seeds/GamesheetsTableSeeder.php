<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GamesheetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gamesheets')->insert([
            'name' => 'Uno',
            'template' => '{
              "type": "game",
              "id": "1",
              "name": "Uno",
              "attributes": {
                "column_header": {
                  "0": {
                    "player_id": 0
                  },
                  "1": {
                    "player_id": 1
                  },
                  "2": {
                    "player_id": 2
                  }
                },
                "row_header": {
                  "0": {
                    "id": 0,
                    "text": "Round 1",
                    "editable": false
                  },
                  "1": {
                    "id": 1,
                    "text": "Round 2",
                    "editable": false
                  },
                  "2": {
                    "id": 2,
                    "text": "Final Round",
                    "editable": true
                  }
                },
                "created": "2015-05-22T14:56:29.000Z",
                "updated": "2015-05-22T14:56:28.000Z"
              }
            }',
            'downloads' => 37,
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('gamesheets')->insert([
            'name' => 'Yahtzee',
            'template' => '{
              "type": "game",
              "id": "2",
              "name": "Yahtzee",
              "attributes": {
                "column_header": {
                  "0": {
                    "player_id": 0
                  },
                  "1": {
                    "player_id": 1
                  },
                  "2": {
                    "player_id": 2
                  }
                },
                "row_header": {
                  "0": {
                    "id": 0,
                    "text": "Round 1 y",
                    "editable": false
                  },
                  "1": {
                    "id": 1,
                    "text": "Round 2 y",
                    "editable": false
                  },
                  "2": {
                    "id": 2,
                    "text": "Final Round y",
                    "editable": true
                  }
                },
                "created": "2015-05-22T14:56:29.000Z",
                "updated": "2015-05-22T14:56:28.000Z"
              }
            }',
            'downloads' => 56,
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
