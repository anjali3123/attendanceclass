<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StanderdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('standerds')->insert([
            ['id' => '1', 'standerd' => '1th',   'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ],
            ['id' => '2', 'standerd' => '2nd',   'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ],
            ['id' => '3', 'standerd' => '3th',   'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ],
            ['id' => '4', 'standerd' => '4th',   'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ],
            ['id' => '5', 'standerd' => '5th',   'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ],
            ['id' => '6', 'standerd' => '6th',   'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ],
            ['id' => '7', 'standerd' => '7th',   'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ],
            ['id' => '8', 'standerd' => '8th',   'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ],
            ['id' => '10', 'standerd' => '9th',   'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"),],
            ['id' => '11', 'standerd' => '10th',   'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ],
            ['id' => '12', 'standerd' => '11th',   'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ],
            ['id' => '13', 'standerd' => '12th',   'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), ],
            
            
        ]);
    }
}