<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_tenant_customers', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')
                ->constrained('svc_tenants')
                ->cascadeOnDelete();
            $table->foreignId('person_id')
                ->constrained('svc_persons')
                ->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->nullable();
            $table->string('email');
            $table->string('password');
            $table->enum('status', ['pending', 'active', 'inactive', 'suspended'])
                ->default('active')
                ->index();
            $table->rememberToken();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['tenant_id', 'email'], 'svc_tenant_customers_tenant_email_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_tenant_customers');
    }
};
