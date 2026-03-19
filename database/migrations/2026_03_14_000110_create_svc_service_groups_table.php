<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_service_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('svc_categories')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_service_groups');
    }
};
