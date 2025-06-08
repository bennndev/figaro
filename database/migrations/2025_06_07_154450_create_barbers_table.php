<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barbers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number');
            $table->string('password');
            $table->string('profile_photo');
            $table->text('description');
            $table->rememberToken();
            $table->timestamps();
        });

         # Tabla de tokens para recuperar contraseña
        Schema::create('password_barbers_reset_tokens', function (Blueprint $table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barbers');
        Schema::dropIfExists('password_barbers_reset_tokens');
    }
};

