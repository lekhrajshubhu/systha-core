<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_companies', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('dba_name')->nullable();
            $table->string('code')->nullable()->unique();
            $table->string('ein', 20)->nullable()->unique();
            $table->string('entity_type')->nullable();
            $table->string('registration_state', 50)->nullable();
            $table->date('incorporation_date')->nullable();
            $table->string('tax_classification')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('industry')->nullable();
            $table->string('naics_code')->nullable();
            $table->string('license_number')->nullable();
            $table->string('status')->default('active');
            $table->text('notes')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('name');
            $table->index('ein');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_companies');
    }
};
