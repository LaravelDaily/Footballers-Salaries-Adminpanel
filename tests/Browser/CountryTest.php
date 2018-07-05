<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CountryTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testCreateCountry()
    {
        $admin = \App\User::find(1);
        $country = factory('App\Country')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $country) {
            $browser->loginAs($admin)
                ->visit(route('admin.countries.index'))
                ->clickLink('Add new')
                ->type("shortcode", $country->shortcode)
                ->type("title", $country->title)
                ->press('Save')
                ->assertRouteIs('admin.countries.index')
                ->assertSeeIn("tr:last-child td[field-key='shortcode']", $country->shortcode)
                ->assertSeeIn("tr:last-child td[field-key='title']", $country->title);
        });
    }

    public function testEditCountry()
    {
        $admin = \App\User::find(1);
        $country = factory('App\Country')->create();
        $country2 = factory('App\Country')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $country, $country2) {
            $browser->loginAs($admin)
                ->visit(route('admin.countries.index'))
                ->click('tr[data-entry-id="' . $country->id . '"] .btn-info')
                ->type("shortcode", $country2->shortcode)
                ->type("title", $country2->title)
                ->press('Update')
                ->assertRouteIs('admin.countries.index')
                ->assertSeeIn("tr:last-child td[field-key='shortcode']", $country2->shortcode)
                ->assertSeeIn("tr:last-child td[field-key='title']", $country2->title);
        });
    }

    public function testShowCountry()
    {
        $admin = \App\User::find(1);
        $country = factory('App\Country')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $country) {
            $browser->loginAs($admin)
                ->visit(route('admin.countries.index'))
                ->click('tr[data-entry-id="' . $country->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='shortcode']", $country->shortcode)
                ->assertSeeIn("td[field-key='title']", $country->title);
        });
    }

}
