<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\YearModel;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insertYear = [
            ['year' => '2024'],
            ['year' => '2025'],
            ['year' => '2026'],
            ['year' => '2027'],
            ['year' => '2028'],
            ['year' => '2029'],
            ['year' => '2030']
        ];

        foreach ($insertYear as $year) {
            YearModel::create($year);
        }
    }
}
