<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_vi');
            $table->string('name_en');
            $table->string('slug')->unique();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('news_articles', function (Blueprint $table) {
            $table->foreignId('news_category_id')
                ->nullable()
                ->after('id')
                ->constrained('news_categories')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('news_articles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('news_category_id');
        });

        Schema::dropIfExists('news_categories');
    }
};
