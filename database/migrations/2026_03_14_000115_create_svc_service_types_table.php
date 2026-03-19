<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_service_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_group_id')->constrained('svc_service_groups')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->unique(['service_group_id', 'slug']);
            $table->index('service_group_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_service_types');
    }
};
