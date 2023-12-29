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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('account_number');
            $table->string('bank_name');
            $table->string('branch_name');
            $table->string('branch_address');
            $table->string('details')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('url')->nullable();
            $table->double('total_deposit')->default(0.00);
            $table->double('total_withdraw')->default(0.00);
            $table->double('total_transfer_from_others')->default(0.00);
            $table->double('total_transfer_to_others')->default(0.00);
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
