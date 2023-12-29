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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string("slug");
            $table->string('sku');
            $table->integer('category_id')->default(1);
            $table->integer('brand_id')->default(1);
            $table->integer('unit_id')->default(1);
            $table->integer('supplier_id')->default(1);
            $table->decimal('unit_purchase_price', 18, 2)->default(0);
            $table->decimal('subunit_purchase_price', 18, 2)->default(0);
            $table->decimal('unit_sale_price', 18, 2)->default(0);
            $table->decimal('subunit_sale_price', 18, 2)->default(0);
            $table->integer('unit_quantity_in_stock')->default(0);
            $table->integer('subunit_quantity_in_stock')->default(0);
            $table->integer('alert_quantity')->default(0);
            $table->date('manufacturing_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('status')->default(1);
            $table->string('tags')->nullable();
            $table->text('description')->nullable();
            $table->integer('created_by')->nullable();
            $table->json('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
