<?php

namespace Tests\Browser\Pages;

use App\Models\Course;
use App\Models\Department;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class CoursePage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/courses';
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
            '@ects'        => 'input[name=ects]',
            '@department'  => 'select[name=department]',
            '@name'        => 'input[name=name]',
            '@description' => 'input[name=description]',
        ];
    }

    public function createNewCourse(Browser $browser, Department $selectDepartment)
    {
        $browser
            ->assertPresent('.new')
            ->assertDontSee('Course DaSe-0101 created successfully')
            ->click(".new")
            ->assertPathIs("/courses/create")
            ->assertPresent('@code')
            ->assertPresent('@name')
            ->assertPresent('@ects')
            ->assertPresent('@department')
            ->assertPresent('@description')
            ->type('name', 'Datamatisk Semantik')
            ->typeSlowly('ects', '15')
            ->type('description', 'This is a description for the course Datamatisk Semantik')
            ->type('code', 'DaSe-0101')
            ->select('department', $selectDepartment->id)
            ->press('.submit')
            ->assertPathIs('/courses')
            ->assertSee('Datamatisk Semantik')
            ->assertSee('15')
            ->assertSee('DaSe-0101')
            ->assertSee('Ether')
            ->assertSee('Course DaSe-0101 created successfully');
    }

    public function showIndex(Browser $browser)
    {
        $browser
            ->assertPresent('.course')
            ->assertSeeIn('.course', 'Datamatisk Semantik')
            ->assertSeeIn('.course','DaSe-0101')
            ->assertSeeIn('.course', '15')
            ->assertPresent(".course a.show")
            ->assertSeeLink('Imada')
            ->clickLink('Imada')
            ->assertPathIs("/departments/*")
            ->assertPathIsNot("/departments/*/*");
    }

    public function showCourse(Browser $browser)
    {
        $browser
            ->assertSee('Datamatisk Semantik')
            ->click('.show')
            ->assertPathIs('/courses/*')
            ->assertPathIsNot('/courses/*/*')
            ->assertSee('Datamatisk Semantik')
            ->assertSee('DaSe-0101')
            ->assertSee('This is a description for the course Datamatisk Semantik')
            ->assertSee('15')
            ->assertSeeLink('Imada')
            ->clickLink('Imada')
            ->assertPathIs('/departments/*')
            ->assertPathIsNot('/departments/*/*');
    }

    /**
     * @param Browser $browser
     * @param Department[] $department
     */
    public function editCourse(Browser $browser, array $department)
    {
        $browser
            ->assertSee('Datamatisk Semantik')
            ->assertDontSee('Course DaSe-0101 updated successfully')
            ->assertPresent('a.show')
            ->click('a.show')
            ->assertPathIs('/courses/*')
            ->assertPresent('a.edit')
            ->click('a.edit')
            ->assertPresent('@code')
            ->assertPresent('@name')
            ->assertPresent('@ects')
            ->assertPresent('@department')
            ->assertPresent('@description')
            ->assertInputValue('code', 'DaSe-0101')
            ->assertInputValue('name', 'Datamatisk Semantik')
            ->assertInputValue('ects', '15')
            ->assertInputValue('description', 'This is a description for the course Datamatisk Semantik')
            ->assertSelected('department', $department[0]->id)
            ->type('code', 'DaSe-0202')
            ->type('name', 'Datamatisk Semantik 2')
            ->type('description', 'Updated description for the course Datamatisk Semantik')
            ->type('ects', '12')
            ->select('department', $department[1]->id)
            ->press('.submit')
            ->assertPathIs("/courses/*")
            ->assertPathIsNot("/courses/*/*")
            ->assertSee('DaSe-0202')
            ->assertSee('Datamatisk Semantik 2')
            ->assertSee('Updated description for the course Datamatisk Semantik')
            ->assertSee('12')
            ->assertSee('Ether')
            ->assertSee('Course DaSe-0202 updated successfully');
    }

    public function deleteCourse(Browser $browser)
    {
        $browser->assertSee('Datamatisk Semantik')
            ->assertDontSee('Course DaSe-0101 successfully removed')
            ->assertPresent('a.show')
            ->click('a.show')
            ->assertPathIs('/courses/*')
            ->assertPresent('.remove')
            ->click('.remove')
            ->assertPathIs('/courses')
            ->assertDontSee('Datamatisk Semantik')
            ->assertSee('Course DaSe-0101 successfully removed');
    }
}
