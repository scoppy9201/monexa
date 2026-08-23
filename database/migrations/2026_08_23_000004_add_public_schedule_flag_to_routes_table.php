<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('routes', 'is_public_schedule')) {
            Schema::table('routes', function (Blueprint $table) {
                $table->boolean('is_public_schedule')->default(false)->after('sort_order');
            });
        }

        Schema::table('routes', function (Blueprint $table) {
            $table->index(
                ['is_public_schedule', 'is_active', 'schedule_group', 'sort_order'],
                'routes_public_schedule_order_idx',
            );
        });
    }

    public function down(): void
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->dropIndex('routes_public_schedule_order_idx');
            $table->dropColumn('is_public_schedule');
        });
    }
};
