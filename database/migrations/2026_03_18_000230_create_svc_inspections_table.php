<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Inspection metadata for service requests in inspection mode.
        Schema::create('svc_inspections', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('request_id')
                ->unique()
                ->constrained('svc_customer_requests')
                ->cascadeOnDelete();
            $table->foreignId('inspected_by_member_id')
                ->nullable()
                ->constrained('svc_tenant_members')
                ->nullOnDelete();
            $table->enum('inspection_status', ['pending', 'submitted', 'reviewed', 'approved'])
                ->default('pending')
                ->index();
            $table->enum('inspection_type', ['initial', 'follow_up', 'post_service']);
            $table->text('summary')->nullable();
            $table->text('findings')->nullable();
            $table->text('recommendation')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('inspected_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_inspections');
    }
};
