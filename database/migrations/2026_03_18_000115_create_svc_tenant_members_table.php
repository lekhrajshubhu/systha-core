<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_tenant_members', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('tenant_id')
                ->constrained('svc_tenants')
                ->cascadeOnDelete();
            $table->foreignId('person_id')
                ->constrained('svc_persons')
                ->cascadeOnDelete();

            // Identity fields
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();

            // Auth tracking
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('password_changed_at')->nullable();

            // Membership fields
            $table->foreignId('role_id')
                ->constrained('svc_roles')
                ->nullable()
                ->restrictOnDelete();
            $table->enum('status', ['pending', 'invited', 'active', 'suspended', 'removed'])->default('pending');
            $table->boolean('is_active')->default(false);
            $table->timestamp('joined_at')->nullable();
            $table->foreignId('invited_by_member_id')
                ->nullable()
                ->constrained('svc_tenant_members')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_tenant_members');
    }
};
