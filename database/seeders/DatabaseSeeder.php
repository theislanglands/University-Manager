<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Course;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // disable foreign key constraints
        // clear tables before seeding -> avoid dublicate data
        DB::table('departments')-> truncate();
        DB::table('courses')-> truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this-> call(DepartmentsTableSeeder::class);
        $this-> call(CoursesTableSeeder::class);
    }
}
