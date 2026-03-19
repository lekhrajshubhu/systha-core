<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Photos attached to inspections.
        Schema::create('svc_inspection_photos', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('inspection_id')
                ->constrained('svc_inspections')
                ->cascadeOnDelete();
            $table->string('disk')->default('media');
            $table->string('file_path');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->foreignId('uploaded_by_member_id')
                ->nullable()
                ->constrained('svc_tenant_members')
                ->nullOnDelete();
            $table->timestamps();

            $table->index(['inspection_id', 'sort_order'], 'svc_inspection_photos_inspection_sort_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_inspection_photos');
    }
};
