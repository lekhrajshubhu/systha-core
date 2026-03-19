<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_item_id')->nullable()->constrained('svc_service_items')->nullOnDelete();
            $table->string('code')->unique();
            $table->string('title');
            $table->enum('field_type', ['radio', 'checkbox', 'select', 'text', 'number', 'date', 'file', 'schedule']);
            $table->boolean('is_required')->default(false);
            $table->boolean('is_start')->default(false);
            $table->foreignId('previous_question_id')->nullable()->constrained('svc_questions')->nullOnDelete();
            $table->foreignId('next_question_id')->nullable()->constrained('svc_questions')->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('service_item_id');
            $table->index('previous_question_id');
            $table->index('next_question_id');
            $table->index(['service_item_id', 'is_start']);
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_questions');
    }
};
