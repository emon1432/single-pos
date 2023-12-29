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
        Schema::create('selling_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('selling_info_id')->constrained('selling_infos')->onDelete('cascade');
            $table->string('invoice_id');
            $table->string('category_id');
            $table->string('brand_id');
            $table->string('supplier_id');
            $table->string('product_id');
            $table->string('product_name');
            $table->double('unit_purchase_price')->default(0.00);
            $table->double('unit_sale_price')->default(0.00);
            $table->double('unit_quantity')->default(0.00);
            $table->double('subunit_purchase_price')->default(0.00);
            $table->double('subunit_sale_price')->default(0.00);
            $table->double('subunit_quantity')->default(0.00);
            $table->double('total_price')->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selling_items');
    }
};
