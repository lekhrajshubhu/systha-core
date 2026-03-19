<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('svc_tenant_payment_credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')
                ->constrained('svc_tenants')
                ->cascadeOnDelete(); // or restrictOnDelete()
            $table->string('name');
            $table->string('code');
            $table->json('credentials');
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('svc_tenant_payment_credentials');
    }
};
