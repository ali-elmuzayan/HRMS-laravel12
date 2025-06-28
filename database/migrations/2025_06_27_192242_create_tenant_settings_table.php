<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenant_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');

            // General Settings
            $table->string('timezone')->default('UTC');
            $table->string('locale')->default('en-US');
            $table->string('date_format')->default('MM/DD/YYYY');
            $table->string('currency', 3)->default('USD');

            // HR Specific Settings
            $table->tinyInteger('week_start_day')->default(1); // 1=Monday
             $table->date('fiscal_year_start')->nullable(); // Simple fixed date
            $table->string('payroll_schedule')->default('BI_WEEKLY');

            // Display Settings
            $table->string('logo_url')->nullable();
            $table->string('primary_color', 7)->nullable();
            $table->string('secondary_color', 7)->nullable();

            // Security Settings
            $table->json('password_policy')->default(json_encode([
                'min_length' => 8,
                'require_upper' => true,
                'require_lower' => true,
                'require_number' => true,
                'require_special' => true,
                'expiry_days' => 90,
                'history_size' => 5
            ]));

            // Notification Settings
            $table->boolean('notifications_enabled')->default(true);
            $table->boolean('notify_on_leave_request')->default(true);
            $table->boolean('notify_on_timesheet_submit')->default(true);

            $table->timestamps();

            $table->unique(['tenant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_settings');
    }
};
