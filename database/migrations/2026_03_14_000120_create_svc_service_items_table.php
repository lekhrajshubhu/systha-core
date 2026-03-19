<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_service_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_group_id')->constrained('svc_service_groups')->cascadeOnDelete();
            $table->foreignId('service_type_id')
                ->nullable()
                ->constrained('svc_service_types')
                ->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->json('meta')->nullable();
            $table->enum('outcome_type', ['booking', 'quote_request', 'inspection', 'subscription']);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('service_group_id');
            $table->index('service_type_id');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_service_items');
    }
};
