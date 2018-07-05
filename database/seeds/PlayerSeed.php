<?php

use Illuminate\Database\Seeder;

class PlayerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Lionel Messi', 'birth_date' => '1987-06-24', 'nationality_id' => 10,],
            ['id' => 2, 'name' => 'Christiano Ronaldo', 'birth_date' => '1985-02-05', 'nationality_id' => 188,],

        ];

        foreach ($items as $item) {
            \App\Player::create($item);
        }
    }
}
