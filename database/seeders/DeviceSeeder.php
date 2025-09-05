<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker; 

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            Device::create([
                'name'       => 'Device ' . $i,
                'os'         => $faker->randomElement(['Android', 'iOS']),
                'owner_name' => $faker->name,
            ]);
        }
    }
}
