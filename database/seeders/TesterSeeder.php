<?php

namespace Database\Seeders;

use App\Models\Tester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker; 

class TesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 30; $i++) {
            Tester::create([
                'name'  => $faker->name,
                'email' => $faker->unique()->safeEmail,
            ]);
        }
    }
}
