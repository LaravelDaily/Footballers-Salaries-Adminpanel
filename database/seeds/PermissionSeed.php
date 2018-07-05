<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'user_management_access',],
            ['id' => 2, 'title' => 'permission_access',],
            ['id' => 3, 'title' => 'permission_create',],
            ['id' => 4, 'title' => 'permission_edit',],
            ['id' => 5, 'title' => 'permission_view',],
            ['id' => 6, 'title' => 'permission_delete',],
            ['id' => 7, 'title' => 'role_access',],
            ['id' => 8, 'title' => 'role_create',],
            ['id' => 9, 'title' => 'role_edit',],
            ['id' => 10, 'title' => 'role_view',],
            ['id' => 11, 'title' => 'role_delete',],
            ['id' => 12, 'title' => 'user_access',],
            ['id' => 13, 'title' => 'user_create',],
            ['id' => 14, 'title' => 'user_edit',],
            ['id' => 15, 'title' => 'user_view',],
            ['id' => 16, 'title' => 'user_delete',],
            ['id' => 17, 'title' => 'country_access',],
            ['id' => 18, 'title' => 'country_create',],
            ['id' => 19, 'title' => 'country_edit',],
            ['id' => 20, 'title' => 'country_view',],
            ['id' => 21, 'title' => 'country_delete',],
            ['id' => 22, 'title' => 'season_access',],
            ['id' => 23, 'title' => 'season_create',],
            ['id' => 24, 'title' => 'season_edit',],
            ['id' => 25, 'title' => 'season_view',],
            ['id' => 26, 'title' => 'season_delete',],
            ['id' => 27, 'title' => 'team_access',],
            ['id' => 28, 'title' => 'team_create',],
            ['id' => 29, 'title' => 'team_edit',],
            ['id' => 30, 'title' => 'team_view',],
            ['id' => 31, 'title' => 'team_delete',],
            ['id' => 32, 'title' => 'player_access',],
            ['id' => 33, 'title' => 'player_create',],
            ['id' => 34, 'title' => 'player_edit',],
            ['id' => 35, 'title' => 'player_view',],
            ['id' => 36, 'title' => 'player_delete',],
            ['id' => 37, 'title' => 'salary_access',],
            ['id' => 38, 'title' => 'salary_create',],
            ['id' => 39, 'title' => 'salary_edit',],
            ['id' => 40, 'title' => 'salary_view',],
            ['id' => 41, 'title' => 'salary_delete',],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
