<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->string('vehicle_type')->nullable()->after('duration_minutes');
            $table->unsignedInteger('schedule_group')->default(1)->after('vehicle_type');
            $table->unsignedInteger('sort_order')->default(0)->after('schedule_group');

            $table->index(['is_active', 'schedule_group', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'schedule_group', 'sort_order']);
            $table->dropColumn(['vehicle_type', 'schedule_group', 'sort_order']);
        });
    }
};
