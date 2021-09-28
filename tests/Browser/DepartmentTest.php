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

class DepartmentTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     *
     * @return void
     */
    public function testCreateNewDepartment()
    {
        $this->browse(function (Browser $browser)
        {
            $browser->visit(new DepartmentPage)
                ->createNewDepartment();
        });
    }

    public function testShowDepartment()
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

                Course::create([
                    'name'          => 'Git Versioning 101',
                    'code'          => 'GiSE-101',
                    'description'   => 'This is a description for the course Git Versioning 101',
                    'ects'          => 25,
                    'department_id' => $department->id
                ]);
            });
        });

        $this->browse(function (Browser $browser)
        {
            $browser->visit(new DepartmentPage())
                ->showDepartment();
        });
    }

    public function testDepartmentIndexWithCourses()
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

                Course::create([
                    'name'          => 'Git Versioning 101',
                    'code'          => 'GiSE-101',
                    'description'   => 'This is a description for the course Git Versioning 101',
                    'ects'          => 25,
                    'department_id' => $department->id
                ]);
            });
        });
        $this->browse(function (Browser $browser)
        {
            $browser->visit(new DepartmentPage)
                ->indexShowCourseCount();
        });
    }

    public function testDepartmentIndexWithNoCourses()
    {
        Department::unguarded(function ()
        {
            Department::create([
                'name'        => 'Imada',
                'description' => 'Institute of Mathematics and Computer Science',
                'code'        => 'XYZ-IMADA'
            ]);
        });
        $this->browse(function (Browser $browser)
        {
            $browser->visit(new DepartmentPage)
                ->indexShowCourseCountZero();
        });
    }

    public function testEditDepartment()
    {
        Department::unguarded(function ()
        {
            Department::create([
                'name'        => 'Imada',
                'description' => 'Institute of Mathematics and Computer Science',
                'code'        => 'XYZ-IMADA'
            ]);
        });


        $this->browse(function (Browser $browser)
        {
            $browser->visit(new DepartmentPage)
                ->editDepartment();
        });
    }

    public function testDeleteDepartment()
    {
        Department::unguarded(function ()
        {
            Department::create([
                'name'        => 'Imada',
                'description' => 'Institute of Mathematics and Computer Science',
                'code'        => 'XYZ-IMADA'
            ]);
        });

        $this->browse(function (Browser $browser)
        {
            $browser->visit(new DepartmentPage())
                ->deleteDepartment();
        });
    }

    public function testCoursesAreRemovedWhenWhenADepartmentIsDeleted()
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

                Course::create([
                    'name'          => 'Git Versioning 101',
                    'code'          => 'GiSE-101',
                    'description'   => 'This is a description for the course Git Versioning 101',
                    'ects'          => 25,
                    'department_id' => $department->id
                ]);
            });
        });

        $this->browse(function (Browser $browser)
        {
            $browser->visit(new DepartmentPage())
                ->deleteDepartmentEnsureCoursesAreRemoved();
        });
    }
}
