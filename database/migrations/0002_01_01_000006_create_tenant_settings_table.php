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


            // general settings:
            $table->decimal('after_miniute_calculate_delay',10,2)->default(0)->comment("بعد كم دقيقة نحسب تاخير حضور	");
            $table->decimal('after_miniute_calculate_early_departure',10,2)->default(0)->comment("بعد كم دقيقة نحسب انصراف مبكر	");
            $table->decimal('after_miniute_quarterday',10,2)->default(0)->comment("بعد كم دقيقه مجموع الانصارف المبكر او الحضور المتأخر نحصم ربع يوم	");
            $table->decimal('after_time_half_daycut',10,2)->default(0)->comment("بعد كم مرة تأخير او انصارف مبكر نخصم نص يوم	");
            $table->decimal('after_time_allday_daycut',10,2)->default(0)->comment("نخصم بعد كم مره تاخير او انصارف مبكر يوم كامل	");
            $table->decimal('monthly_vacation_balance',10,2)->default(0)->comment("رصيد اجازات الموظف الشهري	");
            $table->decimal('after_days_begin_vacation',10,2)->default(0)->comment("بعد كم يوم ينزل للموظف رصيد اجازات	");
            $table->decimal('first_balance_begin_vacation',10,2)->default(0)->comment("الرصيد الاولي المرحل عند تفعيل الاجازات للموظف مثل نزول عشرة ايام ونص بعد سته شهور للموظف	");
            $table->decimal('sanctions_value_first_abcence',10,2)->default(0)->comment("قيمة خصم الايام بعد اول مرة غياب بدون اذن	");
            $table->decimal('sanctions_value_second_abcence',10,2)->default(0)->comment("قيمة خصم الايام بعد ثاني مرة غياب بدون اذن	");
            $table->decimal('sanctions_value_thaird_abcence',10,2)->default(0)->comment("قيمة خصم الايام بعد ثالث مرة غياب بدون اذن	");
            $table->decimal('sanctions_value_forth_abcence',10,2)->default(0)->comment("قيمة خصم الايام بعد رابع مرة غياب بدون اذن	");

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
