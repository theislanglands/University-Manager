<?php

namespace Tests\Browser;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\CoursePage;
use Tests\Browser\Pages\DepartmentPage;
use Tests\DuskTestCase;

class CourseTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     *
     * @return void
     */
    public function testCreateNewCourse()
    {
        $department = null;
        Department::unguarded(function () use (&$department)
        {
            Department::create([
                'name'        => 'Imada',
                'description' => 'Institute of Mathematics and Computer Science',
                'code'        => 'XYZ-IMADA'
            ]);
            $department = Department::create([
                'name'        => 'Ether',
                'description' => 'Gimme dat sweeth ether',
                'code'        => 'ETHER-DOT0'
            ]);
        });

        $this->browse(function (Browser $browser) use ($department)
        {
            $browser->visit(new CoursePage())
                ->createNewCourse($department);
        });
    }

    public function testCourseIndexPage()
    {
        Department::unguarded(function ()
        {
            $department = Department::create([
                'name'        => 'Imada',
                'description' => 'Institute of Mathematics and Computer Science',
                'code'        => 'XYZ-IMADA'
            ]);
            Course::unguarded(function () use ($department)
            {
                Course::create([
                    'name'          => 'Datamatisk Semantik',
                    'code'          => 'DaSe-0101',
                    'description'   => 'This is a description for the course Datamatisk Semantik',
                    'ects'          => 15,
                    'department_id' => $department->id
                ]);
            });
        });

        $this->browse(function (Browser $browser)
        {
            $browser->visit(new CoursePage())
                ->showIndex();
        });
    }

    public function testShowCourse()
    {
        Department::unguarded(function ()
        {
            $department = Department::create([
                'name'        => 'Imada',
                'description' => 'Institute of Mathematics and Computer Science',
                'code'        => 'XYZ-IMADA'
            ]);
            Course::unguarded(function () use ($department)
            {
                Course::create([
                    'name'          => 'Datamatisk Semantik',
                    'code'          => 'DaSe-0101',
                    'description'   => 'This is a description for the course Datamatisk Semantik',
                    'ects'          => 15,
                    'department_id' => $department->id
                ]);
            });
        });

        $this->browse(function (Browser $browser)
        {
            $browser->visit(new CoursePage())
                ->showCourse();
        });
    }

    public function testEditCourse()
    {
        $department = null;
        Department::unguarded(function () use (&$department)
        {
            $department[] = Department::create([
                'name'        => 'Imada',
                'description' => 'Institute of Mathematics and Computer Science',
                'code'        => 'XYZ-IMADA'
            ]);
            $department[] = Department::create([
                'name'        => 'Ether',
                'description' => 'Gimme dat sweeth ether',
                'code'        => 'ETHER-DOT0'
            ]);
            Course::unguarded(function () use ($department)
            {
                Course::create([
                    'name'          => 'Datamatisk Semantik',
                    'code'          => 'DaSe-0101',
                    'description'   => 'This is a description for the course Datamatisk Semantik',
                    'ects'          => 15,
                    'department_id' => $department[0]->id
                ]);
            });
        });


        $this->browse(function (Browser $browser) use ($department)
        {
            $browser->visit(new CoursePage())
                ->editCourse($department);
        });
    }

    public function testDeleteCourse()
    {
        Department::unguarded(function ()
        {
            $department = Department::create([
                'name'        => 'Imada',
                'description' => 'Institute of Mathematics and Computer Science',
                'code'        => 'XYZ-IMADA'
            ]);
            Course::unguarded(function () use ($department)
            {
                Course::create([
                    'name'          => 'Datamatisk Semantik',
                    'code'          => 'DaSe-0101',
                    'description'   => 'This is a description for the course Datamatisk Semantik',
                    'ects'          => 15,
                    'department_id' => $department->id
                ]);
            });
        });
        $this->browse(function (Browser $browser)
        {
            $browser->visit(new CoursePage())
                ->deleteCourse();
        });
    }
}
