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
        Schema::create('selling_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('selling_info_id')->constrained('selling_infos')->onDelete('cascade');
            $table->string('invoice_id');
            $table->string('discount_type')->default('plain');
            $table->double('discount_amount')->default(0.00);
            $table->double('order_tax')->default(0.00);
            $table->string('shipping_type')->default('plain');
            $table->double('shipping_amount')->default(0.00);
            $table->double('others_charge')->default(0.00);
            $table->double('subtotal');
            $table->double('payable_amount')->default(0.00);
            $table->double('total_purchase_price')->default(0.00);
            $table->double('paid_amount')->default(0.00);
            $table->double('due_amount')->default(0.00);
            $table->string('profit')->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selling_prices');
    }
};
