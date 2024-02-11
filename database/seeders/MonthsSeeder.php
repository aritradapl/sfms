<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Months;

class MonthsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            ['month_name'=>'January'],
            ['month_name'=>'February'],
            ['month_name'=>'March'],
            ['month_name'=>'April'],
            ['month_name'=>'May'],
            ['month_name'=>'June'],
            ['month_name'=>'July'],
            ['month_name'=>'August'],
            ['month_name'=>'September'],
            ['month_name'=>'October'],
            ['month_name'=>'November'],
            ['month_name'=>'December']
        ];
        Months::insert($data);
    }
}
