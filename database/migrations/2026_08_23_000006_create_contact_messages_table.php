<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('department')->default('futabus');
            $table->string('name');
            $table->string('email');
            $table->string('phone', 20);
            $table->string('subject');
            $table->text('message');
            $table->enum('status', ['new', 'processing', 'resolved'])->default('new');
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
