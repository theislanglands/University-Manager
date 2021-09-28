<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\MainPage;
use Tests\DuskTestCase;

class VisitHomepageTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testHomepage()
    {
        $this->browse(function (Browser $browser)
        {
            $browser->visit(new MainPage)
                ->pageContainsWelcomeAndLinks();
        });
    }
}
