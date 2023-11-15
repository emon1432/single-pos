<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->default(2)->constrained('roles')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->double('balance')->default(0.00);
            $table->string('address')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->json('image')->nullable();
            $table->rememberToken();
            $table->integer('status')->default(1);
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
