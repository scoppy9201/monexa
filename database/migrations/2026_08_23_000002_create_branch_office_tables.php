<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branch_regions', function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->json('name');
            $table->boolean('is_active')->default(true)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->timestamps();
        });

        Schema::create('branch_offices', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('branch_region_id')->constrained()->cascadeOnDelete();
            $table->json('name');
            $table->json('address');
            $table->string('phone', 30)->nullable();
            $table->string('map_query')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->timestamps();

            $table->index(['branch_region_id', 'is_active', 'sort_order'], 'branch_offices_directory_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branch_offices');
        Schema::dropIfExists('branch_regions');
    }
};
