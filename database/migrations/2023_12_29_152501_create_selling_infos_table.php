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
        Schema::create('selling_infos', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('invoice_type')->default('sell');
            $table->string('customer_id')->default(1);
            $table->string('customer_phone')->nullable();
            $table->string('note')->nullable();
            $table->string('total_items')->default(0);
            $table->string('status')->default('0');
            $table->string('payment_method_id')->default(1);
            $table->string('payment_status')->nullable();
            $table->string('checkout_status')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selling_infos');
    }
};
