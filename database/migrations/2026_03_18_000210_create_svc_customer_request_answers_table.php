<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Snapshot of submitted answers (no dependency on question system).
        Schema::create('svc_customer_request_answers', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('request_id')
                ->constrained('svc_customer_requests')
                ->cascadeOnDelete();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->string('question_code')->index();
            $table->text('question_text');
            $table->text('answer')->nullable();
            $table->enum('price_type', ['base', 'adjustment'])->default('adjustment');
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['request_id', 'sort_order'], 'svc_customer_request_answers_request_sort_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_customer_request_answers');
    }
};
