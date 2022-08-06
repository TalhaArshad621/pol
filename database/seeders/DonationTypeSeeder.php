<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DonationType;

class DonationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DonationType::create([
            'type' => 'blood',
            'frequency_days' => 56
        ]);
        DonationType::create([
            'type' => 'platelets',
            'frequency_days' => 7
        ]);
        DonationType::create([
            'type' => 'plasma',
            'frequency_days' => 28
        ]);
        DonationType::create([
            'type' => 'power_red',
            'frequency_days' => 112
        ]);
    }
}
