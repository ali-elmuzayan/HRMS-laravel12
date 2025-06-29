<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::pluck('id')->toArray();

        $parent = Department::factory()->create([
            'tenant_id' => Arr::random($tenants),
        ]);


        Department::factory()
            ->for($parent, 'parent')
            ->create(
                [
                    'tenant_id' => $parent->tenant_id,
                ]
            );


        Department::factory()->hr()->create();
        Department::factory()->it()->create();
        Department::factory()->finance()->create();
    }
}
