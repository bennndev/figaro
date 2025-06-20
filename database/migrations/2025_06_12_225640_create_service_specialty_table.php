<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('service_specialty', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            # Evitar duplicados
            $table->unique(['service_id', 'specialty_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_specialty');
    }
};  
