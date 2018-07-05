<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class SalaryTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateSalary()
    {
        $admin = \App\User::find(1);
        $salary = factory('App\Salary')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $salary) {
            $browser->loginAs($admin)
                ->visit(route('admin.salaries.index'))
                ->clickLink('Add new')
                ->select("player_id", $salary->player_id)
                ->select("team_id", $salary->team_id)
                ->select("season_id", $salary->season_id)
                ->type("salary", $salary->salary)
                ->press('Save')
                ->assertRouteIs('admin.salaries.index')
                ->assertSeeIn("tr:last-child td[field-key='player']", $salary->player->name)
                ->assertSeeIn("tr:last-child td[field-key='team']", $salary->team->name)
                ->assertSeeIn("tr:last-child td[field-key='season']", $salary->season->season)
                ->assertSeeIn("tr:last-child td[field-key='salary']", $salary->salary);
        });
    }

    public function testEditSalary()
    {
        $admin = \App\User::find(1);
        $salary = factory('App\Salary')->create();
        $salary2 = factory('App\Salary')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $salary, $salary2) {
            $browser->loginAs($admin)
                ->visit(route('admin.salaries.index'))
                ->click('tr[data-entry-id="' . $salary->id . '"] .btn-info')
                ->select("player_id", $salary2->player_id)
                ->select("team_id", $salary2->team_id)
                ->select("season_id", $salary2->season_id)
                ->type("salary", $salary2->salary)
                ->press('Update')
                ->assertRouteIs('admin.salaries.index')
                ->assertSeeIn("tr:last-child td[field-key='player']", $salary2->player->name)
                ->assertSeeIn("tr:last-child td[field-key='team']", $salary2->team->name)
                ->assertSeeIn("tr:last-child td[field-key='season']", $salary2->season->season)
                ->assertSeeIn("tr:last-child td[field-key='salary']", $salary2->salary);
        });
    }

    public function testShowSalary()
    {
        $admin = \App\User::find(1);
        $salary = factory('App\Salary')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $salary) {
            $browser->loginAs($admin)
                ->visit(route('admin.salaries.index'))
                ->click('tr[data-entry-id="' . $salary->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='player']", $salary->player->name)
                ->assertSeeIn("td[field-key='team']", $salary->team->name)
                ->assertSeeIn("td[field-key='season']", $salary->season->season)
                ->assertSeeIn("td[field-key='salary']", $salary->salary);
        });
    }

}
