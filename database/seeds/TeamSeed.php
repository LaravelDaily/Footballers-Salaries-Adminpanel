<?php

use Illuminate\Database\Seeder;

class TeamSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'FC Barcelona', 'country_id' => 218,],
            ['id' => 2, 'name' => 'Real Madrid', 'country_id' => 218,],

        ];

        foreach ($items as $item) {
            \App\Team::create($item);
        }
    }
}
