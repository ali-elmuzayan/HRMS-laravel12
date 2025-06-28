<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Get the admin tenant
        $adminTenant = Tenant::where('slug', 'admin-tenant')->first();

        // Create system roles for admin tenant
        Role::firstOrCreate(
            ['name' => 'super-admin', 'tenant_id' => $adminTenant->id],
            ['description' => 'Super Administrator with full access']
        );

        // Create default roles for all tenants
        Tenant::all()->each(function ($tenant) {
            Role::firstOrCreate(
                ['name' => 'admin', 'tenant_id' => $tenant->id],
                ['description' => 'Tenant Administrator']
            );

            Role::firstOrCreate(
                ['name' => 'manager', 'tenant_id' => $tenant->id],
                ['description' => 'Department Manager']
            );

            Role::firstOrCreate(
                ['name' => 'employee', 'tenant_id' => $tenant->id],
                ['description' => 'Regular Employee']
            );
        });
    }
}

