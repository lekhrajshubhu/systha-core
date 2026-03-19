<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Parent table for all service request flows (free estimation, inspection, schedule, subscription).
        Schema::create('svc_customer_requests', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')
                ->constrained('svc_tenants')
                ->cascadeOnDelete();
            $table->foreignId('tenant_customer_id')
                ->constrained('svc_tenant_customers')
                ->cascadeOnDelete();
            $table->foreignId('service_item_id')
                ->constrained('svc_service_items')
                ->cascadeOnDelete();
            $table->foreignId('created_by_member_id')
                ->nullable()
                ->constrained('svc_tenant_members')
                ->nullOnDelete();

            $table->enum('request_mode', ['free_estimation', 'inspection', 'schedule_service', 'subscription'])
                ->index();
            $table->enum('status', ['draft', 'submitted', 'in_progress', 'completed', 'cancelled'])
                ->default('draft')
                ->index();

            $table->string('service_title');
            $table->decimal('base_price', 10, 2)->nullable();
            $table->decimal('total_adjustment', 10, 2)->nullable();
            $table->decimal('final_amount', 10, 2)->nullable();
            $table->string('currency', 3)->nullable();
            $table->text('customer_notes')->nullable();
            $table->text('internal_notes')->nullable();
            $table->json('raw_answers')->nullable();
            $table->json('pricing_snapshot')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['tenant_id', 'status'], 'svc_customer_requests_tenant_status_index');
            $table->index(['tenant_id', 'request_mode'], 'svc_customer_requests_tenant_mode_index');
            $table->index('service_item_id', 'svc_customer_requests_service_item_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_customer_requests');
    }
};
