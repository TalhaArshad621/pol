<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LocationCode;

class LocationCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LocationCode::create([
            'lc'          => 'POLF',
            'description' => 'Point Of Life Facility'
        ]);
        LocationCode::create([
            'lc'          => 'BDHS',
            'description' => 'Blood Drive-high School'
        ]);
        LocationCode::create([
            'lc'          => 'BDUN',
            'description' => 'Blood Drive-University'
        ]);
        LocationCode::create([
            'lc'          => 'BDOG',
            'description' => 'Blood Drive-Organization'
        ]);
        LocationCode::create([
            'lc'          => 'CLIN',
            'description' => 'Clinics'
        ]);
        LocationCode::create([
            'lc'          => 'HSPT',
            'description' => 'Hospital'
        ]);
    }
}
