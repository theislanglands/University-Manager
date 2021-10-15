<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // courses for NAT (id=1)
        DB::table('courses')-> insert([
            'department_id' => 1, // NAT
            'created_at' => now(),
            'updated_at' => now(),
            'name' => 'Calculus',
            'code' => 'CAL',
            'ects' => 5,
            'description' => 'Coarse in calculus'
        ]);

        DB::table('courses')-> insert([
            'department_id' => 1, // NAT
            'created_at' => now(),
            'updated_at' => now(),
            'name' => 'Advanced physics',
            'code' => 'APhys',
            'ects' => 5,
            'description' => 'Coarse in advanced physics'
        ]);

        // courses for Humaniora (id=2)
        DB::table('courses')-> insert([
            'department_id' => 2, // HUM
            'created_at' => now(),
            'updated_at' => now(),
            'name' => 'English Business Language',
            'code' => 'EBL',
            'ects' => 5,
            'description' => 'Coarse in English Business Language'
        ]);

        DB::table('courses')-> insert([
            'department_id' => 2, // HUM
            'created_at' => now(),
            'updated_at' => now(),
            'name' => 'Antropology',
            'code' => 'ANT',
            'ects' => 5,
            'description' => 'Coarse in Antropology'
        ]);
    }
}
