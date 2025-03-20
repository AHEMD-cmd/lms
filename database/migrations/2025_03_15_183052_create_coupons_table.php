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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->index();
            $table->enum('type', ['platform', 'instructor', 'course'])->default('platform')->comment('platform = means for the platform, instructor = means for instructor, course = means for course');
            $table->boolean('auto_applied')->default(0)->comment('0 = no, 1 = yes');
            $table->foreignId('instructor_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('course_id')->nullable()->constrained('courses')->cascadeOnDelete();
            $table->integer('discount_percentage')->nullable();
            $table->dateTime('start_date')->index();
            $table->dateTime('end_date')->index();
            $table->integer('limit_number')->nullable()->comment('The number of times the coupon can be used');
            $table->integer('times_used')->default(0)->comment('The number of times the coupon has been used');
            $table->boolean('is_active')->default(1)->comment('1 = active, 0 = inactive');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
