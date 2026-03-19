<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_service_item_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_item_id')->constrained('svc_service_items')->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('svc_questions')->cascadeOnDelete();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_start')->default(false);
            $table->timestamps();

            $table->unique(['service_item_id', 'question_id']);
            $table->index('service_item_id');
            $table->index('question_id');
            $table->index(['service_item_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_service_item_questions');
    }
};
