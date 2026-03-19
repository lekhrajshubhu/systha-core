<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_request_tenant_quotes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('request_id')
                ->constrained('svc_customer_requests')
                ->cascadeOnDelete();
            $table->foreignId('tenant_id')
                ->constrained('svc_tenants')
                ->cascadeOnDelete();
            $table->enum('status', ['pending', 'quoted', 'accepted', 'rejected', 'expired'])
                ->default('pending')
                ->index();
            $table->decimal('amount', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('quoted_at')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();

            $table->unique(['request_id', 'tenant_id'], 'svc_request_tenant_quotes_request_tenant_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_request_tenant_quotes');
    }
};
