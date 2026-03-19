<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('svc_questions')->cascadeOnDelete();
            $table->string('label');
            $table->string('value');
            $table->decimal('price_adjustment', 10, 2)->default(0);
            $table->foreignId('next_question_id')->nullable()->constrained('svc_questions')->nullOnDelete();
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('question_id');
            $table->index('next_question_id');
            $table->index(['question_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_question_options');
    }
};
