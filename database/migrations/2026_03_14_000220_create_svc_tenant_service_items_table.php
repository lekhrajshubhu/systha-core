<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_tenant_service_items', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')
                ->constrained('svc_tenants')
                ->cascadeOnDelete();
            $table->foreignId('service_item_id')
                ->constrained('svc_service_items')
                ->cascadeOnDelete();
            $table->boolean('is_active')->default(true)->index();
            $table->decimal('base_price', 10, 2)->nullable();
            $table->char('currency', 3)->default('USD');
            $table->unsignedInteger('lead_time_hours')->nullable();
            $table->timestamps();

            $table->unique(['tenant_id', 'service_item_id'], 'svc_tenant_service_items_tenant_service_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_tenant_service_items');
    }
};
