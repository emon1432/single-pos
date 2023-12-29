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
        Schema::create('sell_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('selling_info_id')->constrained('selling_infos')->onDelete('cascade');
            $table->string('invoice_id');
            $table->string('customer_id');
            $table->string('type');
            $table->string('payment_method_id');
            $table->string('payment_reference')->nullable();
            $table->double('paid_amount')->default(0.00);
            $table->double('due_amount')->default(0.00);
            $table->string('note')->nullable();
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_logs');
    }
};
