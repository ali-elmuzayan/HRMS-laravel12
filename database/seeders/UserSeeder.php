<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create super admin user - NO manual ID
        $adminTenant = Tenant::where('slug', 'admin-tenant')->first();
        $superAdminRole = Role::where('name', 'super-admin')->first();

        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role_id' => $superAdminRole->id,
                'tenant_id' => $adminTenant->id,
                'is_active' => true,
            ]
        );

        // Create admin users for each tenant - NO manual ID
        Tenant::all()->each(function ($tenant) {
            $adminRole = Role::where('tenant_id', $tenant->id)
                          ->where('name', 'admin')
                          ->first();

            User::firstOrCreate(
                ['email' => 'admin@'.$tenant->slug.'.com'],
                [
                    'name' => $tenant->name.' Admin',
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'),
                    'role_id' => $adminRole->id,
                    'tenant_id' => $tenant->id,
                    'is_active' => true,
                ]
            );

            // Create regular users - Factory will handle ID automatically
            User::factory()
                ->count(5)
                ->create(['tenant_id' => $tenant->id]);
        });

        // Assign roles to any users without roles
        User::whereNull('role_id')->each(function ($user) {
            $roles = Role::where('tenant_id', $user->tenant_id)->get();
            if ($roles->isNotEmpty()) {
                $user->update(['role_id' => $roles->random()->id]);
            }
        });
    }
}
