<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('svc_addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->string('type')->default('default')->index(); // e.g., billing, shipping, office, home
            
            $table->string('line_1');
            $table->string('line_2')->nullable();
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country');
            
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('svc_addresses');
    }
};
