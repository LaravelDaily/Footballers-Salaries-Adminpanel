<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(CountrySeed::class);
        $this->call(PermissionSeed::class);
        $this->call(PlayerSeed::class);
        $this->call(RoleSeed::class);
        $this->call(SeasonSeed::class);
        $this->call(TeamSeed::class);
        $this->call(SalarySeed::class);
        $this->call(UserSeed::class);
        $this->call(RoleSeedPivot::class);
        $this->call(UserSeedPivot::class);

    }
}
