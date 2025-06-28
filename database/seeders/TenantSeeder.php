<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        // Create main admin tenant
        Tenant::firstOrCreate(
            ['slug' => 'admin-tenant'],
            [
                'name' => 'Admin Tenant',
                'plan' => 'enterprise',
                'is_active' => true,
            ]
        );

        // Create additional tenants
        Tenant::factory()->count(5)->create();
    }

}
