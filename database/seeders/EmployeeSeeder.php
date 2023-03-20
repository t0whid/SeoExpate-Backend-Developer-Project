<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
           
                'name' => 'Rowja Mehjabeen-4',
                'title' => 'Web Developer',
                'company' => 'Google',
                'email' => 'rowja4@gmail.com',
                'phone' => '01700000000',
                'location' => 'Dhaka',
                'total_employees' => '150',
                'industry' => 'computer, software',
           
        ]);
    }
}
