<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_tenants', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->enum('status', ['active', 'inactive'])->default('active')->index();
            $table->string('timezone')->nullable();
            $table->string('currency', 3)->nullable();
            $table->string('phone')->nullable()->index();
            $table->string('logo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_tenants');
    }
};
