<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tanents = Tenant::pluck('id')->toArray();
        // add tenants id for each 10 employee then move to next 10 employee
        Employee::factory()->count(1000)->sequence(function ($sequence) use ($tanents) {
            return [
                'tenant_id' => Arr::random($tanents),
            ];
        })->create();
    }
}
