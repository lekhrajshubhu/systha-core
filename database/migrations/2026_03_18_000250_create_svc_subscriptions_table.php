<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Subscription metadata for service requests in subscription mode.
        Schema::create('svc_subscriptions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('request_id')
                ->unique()
                ->constrained('svc_customer_requests')
                ->cascadeOnDelete();
            $table->foreignId('service_address_id')
                ->nullable()
                ->constrained('svc_addresses')
                ->nullOnDelete();
            $table->enum('frequency_unit', ['week', 'month', 'year']);
            $table->unsignedInteger('frequency_interval');
            $table->date('start_date');
            $table->time('preferred_time_start')->nullable();
            $table->time('preferred_time_end')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('subscription_status', ['pending', 'active', 'paused', 'cancelled'])
                ->default('pending')
                ->index();
            $table->decimal('recurring_amount', 10, 2);
            $table->boolean('auto_generate_appointments')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_subscriptions');
    }
};
