<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class SeasonTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateSeason()
    {
        $admin = \App\User::find(1);
        $season = factory('App\Season')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $season) {
            $browser->loginAs($admin)
                ->visit(route('admin.seasons.index'))
                ->clickLink('Add new')
                ->type("season", $season->season)
                ->press('Save')
                ->assertRouteIs('admin.seasons.index')
                ->assertSeeIn("tr:last-child td[field-key='season']", $season->season);
        });
    }

    public function testEditSeason()
    {
        $admin = \App\User::find(1);
        $season = factory('App\Season')->create();
        $season2 = factory('App\Season')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $season, $season2) {
            $browser->loginAs($admin)
                ->visit(route('admin.seasons.index'))
                ->click('tr[data-entry-id="' . $season->id . '"] .btn-info')
                ->type("season", $season2->season)
                ->press('Update')
                ->assertRouteIs('admin.seasons.index')
                ->assertSeeIn("tr:last-child td[field-key='season']", $season2->season);
        });
    }

    public function testShowSeason()
    {
        $admin = \App\User::find(1);
        $season = factory('App\Season')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $season) {
            $browser->loginAs($admin)
                ->visit(route('admin.seasons.index'))
                ->click('tr[data-entry-id="' . $season->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='season']", $season->season);
        });
    }

}
