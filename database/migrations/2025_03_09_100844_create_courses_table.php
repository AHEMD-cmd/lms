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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->foreignId('instructor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('image')->nullable();
            $table->text('title')->nullable();
            $table->text('name')->nullable();
            $table->string('slug')->nullable();

            $table->longText('description')->nullable();
            $table->string('video')->nullable();
            $table->string('level')->nullable();
            $table->string('duration')->nullable();
            $table->string('resources')->nullable();
            $table->boolean('has_certificate')->nullable();

            $table->integer('price')->nullable();
            $table->integer('discount')->nullable();
            $table->text('prerequisites')->nullable();
            $table->boolean('bestseller')->nullable()->default(0);
            $table->boolean('featured')->nullable()->default(0);
            $table->boolean('highest_rated')->nullable()->default(0);
            $table->tinyInteger('status')->default(0)->comment('0=Inactive','1=Active'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
