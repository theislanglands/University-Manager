<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')-> insert([
            'name' => 'Naturvidenskab',
            'code' => 'NAT',
            'description' => 'The faculty of natural sciences',
            'created_at' => now(),
            'updated_at' => now()
            ]);

        DB::table('departments')-> insert([
            'name' => 'Humaniora',
            'code' => 'HUM',
            'description' => 'The faculty of humaniora',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('departments')-> insert([
            'name' => 'Samfundsvidenskab',
            'code' => 'SAMF',
            'description' => 'The faculty of samfunsvidenskab',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
