<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_admins', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_active')->default(true)->index();
            $table->rememberToken();
            $table->timestamps();

            $table->index(['email', 'is_active'], 'svc_admins_email_is_active_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_admins');
    }
};
