<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class DepartmentPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/departments';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param Browser $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@code'        => 'input[name=code]',
            '@description' => 'input[name=description]',
            '@name'        => 'input[name=name]',
        ];
    }

    public function createNewDepartment(Browser $browser)
    {
        $browser
            ->assertPresent('.new')
            ->assertDontSee('Department XYZ-IMADA created successfully')
            ->click(".new")
            ->assertPathIs("/departments/create")
            ->assertPresent('@code')
            ->assertPresent('@name')
            ->assertPresent('@description')
            ->type('name', 'Imada')
            ->type('description', 'Institute of Mathematics and Computer Science')
            ->type('code', 'XYZ-IMADA')
            ->press('.submit')
            ->assertPathIs('/departments')
            ->assertSeeIn('.department', 'Imada')
            ->assertSeeIn('.department', 'XYZ-IMADA')
            ->assertSeeIn('.department', '0');
    }

    public function indexShowCourseCount(Browser $browser)
    {
        $browser
            ->assertPresent('.department')
            ->assertSeeIn('.department', 'Imada')
            ->assertSeeIn('.department', 'XYZ-IMADA')
            ->assertSeeIn('.department', '2');
    }

    public function indexShowCourseCountZero(Browser $browser)
    {
        $browser
            ->assertPresent('.department')
            ->assertSeeIn('.department', 'Imada')
            ->assertSeeIn('.department', 'XYZ-IMADA')
            ->assertSeeIn('.department', '0');
    }

    public function showDepartment(Browser $browser)
    {
        $browser
            ->assertSee('Imada')
            ->click('.show')
            ->assertPathIs('/departments/*')
            ->assertPathIsNot('/departments/*/*')
            ->assertSee('Imada')
            ->assertSee('Institute of Mathematics and Computer Science')
            ->assertSee('XYZ-IMADA')
            ->assertSeeIn('.course', 'Datamatisk Semantik')
            ->assertSeeIn('.course', 'DaSe-0101')
            ->assertSeeIn('.course', '15')
            ->assertPresent('.course a.show')
            ->click('.course a.show')
            ->assertPathIs('/courses/*')
            ->assertPathIsNot('/courses/*/*')
            ->assertSee('Datamatisk Semantik')
            ->assertDontSee('Git Versioning 101');
    }

    public function editDepartment(Browser $browser)
    {
        $browser->assertSee('Imada')
            ->assertDontSee('Department ZYX-IMADA updated successfully')
            ->assertPresent('a.show')
            ->click('a.show')
            ->assertPathIs('/departments/*')
            ->assertPresent('a.edit')
            ->click('a.edit')
            ->assertPresent('@code')
            ->assertPresent('@name')
            ->assertPresent('@description')
            ->assertInputValue('code', 'XYZ-IMADA')
            ->assertInputValue('name', 'Imada')
            ->assertInputValue('description', 'Institute of Mathematics and Computer Science')
            ->type('code', 'ZYX-IMADA')
            ->type('name', 'MIMADA')
            ->type('description', 'Tek is probably better than Imada')
            ->press('.submit')
            ->assertPathIs("/departments/*")
            ->assertPathIsNot('/departments/*/*')
            ->assertSee('Tek is probably better than Imada')
            ->assertSee('ZYX-IMADA')
            ->assertSee('MIMADA')
            ->assertSee('Department ZYX-IMADA updated successfully');
    }

    public function deleteDepartment(Browser $browser)
    {
        $browser->assertSee('Imada')
            ->assertDontSee('Department XYZ-IMADA successfully removed')
            ->assertPresent('a.show')
            ->click('a.show')
            ->assertPathIs('/departments/*')
            ->assertPathIsNot('/departments/*/*')
            ->assertPresent('.remove')
            ->click('.remove')
            ->assertPathIs('/departments')
            ->assertDontSee('Imada')
            ->assertSee('Department XYZ-IMADA successfully removed');
    }

    public function deleteDepartmentEnsureCoursesAreRemoved(Browser $browser)
    {
        $browser
            ->assertSee('Imada')
            ->visit('/courses')
            ->assertSee("Datamatisk Semantik")
            ->assertSee("Git Versioning 101")
            ->visit('/departments')
            ->assertPresent('.show')
            ->click('.show')
            ->assertPresent('.remove')
            ->click('.remove')
            ->visit('/departments')
            ->assertDontSee('Imada')
            ->visit('/courses')
            ->assertDontSee('Datamatisk Semantik')
            ->assertDontSee('Git Versioning 101');
    }
}
