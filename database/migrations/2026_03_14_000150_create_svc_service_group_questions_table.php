<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_service_group_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_group_id')->constrained('svc_service_groups')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('svc_questions')->cascadeOnDelete();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_start')->default(false);
            $table->timestamps();

            $table->unique(['service_group_id', 'question_id']);
            $table->index('service_group_id');
            $table->index('question_id');
            $table->index(['service_group_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_service_group_questions');
    }
};
