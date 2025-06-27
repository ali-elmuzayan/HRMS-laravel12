<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('employee_code')->nullable(); // Internal employee ID
            $table->date('joining_date')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('national_id')->nullable(); // or social security number
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('contract_type')->nullable(); // Full-time, Part-time, etc.
            $table->string('work_shift')->nullable();    // Morning, Night, etc.
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->foreignUuid('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
