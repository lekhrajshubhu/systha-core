<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Shared scheduling system for service requests and subscriptions.
        Schema::create('svc_appointments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')
                ->constrained('svc_tenants')
                ->cascadeOnDelete();
            $table->foreignId('request_id')
                ->nullable()
                ->constrained('svc_customer_requests')
                ->nullOnDelete();
            $table->foreignId('subscription_id')
                ->nullable()
                ->constrained('svc_subscriptions')
                ->nullOnDelete();
            $table->foreignId('tenant_customer_id')
                ->constrained('svc_tenant_customers')
                ->cascadeOnDelete();
            $table->foreignId('assigned_member_id')
                ->nullable()
                ->constrained('svc_tenant_members')
                ->nullOnDelete();
            $table->foreignId('service_address_id')
                ->nullable()
                ->constrained('svc_addresses')
                ->nullOnDelete();

            $table->enum('appointment_type', ['inspection', 'service', 'subscription_visit']);
            $table->date('appointment_date');
            $table->time('time_start');
            $table->time('time_end')->nullable();
            $table->string('timezone');
            $table->enum('status', ['pending', 'confirmed', 'assigned', 'in_progress', 'completed', 'cancelled', 'no_show'])
                ->default('pending')
                ->index();
            $table->text('access_notes')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();

            $table->index(['tenant_id', 'appointment_date'], 'svc_appointments_tenant_date_index');
            $table->index('request_id', 'svc_appointments_request_index');
            $table->index('subscription_id', 'svc_appointments_subscription_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_appointments');
    }
};
