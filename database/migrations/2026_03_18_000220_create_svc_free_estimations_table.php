<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Free estimation metadata for service requests in free_estimation mode.
        Schema::create('svc_free_estimations', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('request_id')
                ->unique()
                ->constrained('svc_customer_requests')
                ->cascadeOnDelete();
            $table->enum('status', ['new', 'reviewing', 'quoted', 'converted', 'closed'])
                ->default('new')
                ->index();
            $table->timestamp('quoted_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_free_estimations');
    }
};
