<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_person_companies', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('person_id')
                ->constrained('svc_persons')
                ->cascadeOnDelete();
            $table->foreignId('company_id')
                ->constrained('svc_companies')
                ->cascadeOnDelete();
            $table->string('relation_type')->default('contact');
            $table->string('job_title')->nullable();
            $table->string('department')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_active')->default(true);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('notes')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->unique(['person_id', 'company_id']);
            $table->index(['company_id', 'relation_type']);
            $table->index(['person_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_person_companies');
    }
};
