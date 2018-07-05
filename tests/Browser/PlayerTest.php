<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PlayerTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreatePlayer()
    {
        $admin = \App\User::find(1);
        $player = factory('App\Player')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $player) {
            $browser->loginAs($admin)
                ->visit(route('admin.players.index'))
                ->clickLink('Add new')
                ->type("name", $player->name)
                ->type("birth_date", $player->birth_date)
                ->select("nationality_id", $player->nationality_id)
                ->press('Save')
                ->assertRouteIs('admin.players.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $player->name)
                ->assertSeeIn("tr:last-child td[field-key='birth_date']", $player->birth_date)
                ->assertSeeIn("tr:last-child td[field-key='nationality']", $player->nationality->title);
        });
    }

    public function testEditPlayer()
    {
        $admin = \App\User::find(1);
        $player = factory('App\Player')->create();
        $player2 = factory('App\Player')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $player, $player2) {
            $browser->loginAs($admin)
                ->visit(route('admin.players.index'))
                ->click('tr[data-entry-id="' . $player->id . '"] .btn-info')
                ->type("name", $player2->name)
                ->type("birth_date", $player2->birth_date)
                ->select("nationality_id", $player2->nationality_id)
                ->press('Update')
                ->assertRouteIs('admin.players.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $player2->name)
                ->assertSeeIn("tr:last-child td[field-key='birth_date']", $player2->birth_date)
                ->assertSeeIn("tr:last-child td[field-key='nationality']", $player2->nationality->title);
        });
    }

    public function testShowPlayer()
    {
        $admin = \App\User::find(1);
        $player = factory('App\Player')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $player) {
            $browser->loginAs($admin)
                ->visit(route('admin.players.index'))
                ->click('tr[data-entry-id="' . $player->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $player->name)
                ->assertSeeIn("td[field-key='birth_date']", $player->birth_date)
                ->assertSeeIn("td[field-key='nationality']", $player->nationality->title);
        });
    }

}
