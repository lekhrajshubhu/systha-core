<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_role_permissions', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('role_id')
                ->constrained('svc_roles')
                ->cascadeOnDelete();
            $table->foreignId('permission_id')
                ->constrained('svc_permissions')
                ->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['role_id', 'permission_id'], 'svc_role_permissions_role_permission_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_role_permissions');
    }
};
