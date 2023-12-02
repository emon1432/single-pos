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
            $table->string('code');
            $table->integer('category_id')->default(1);
            $table->integer('brand_id')->default(1);
            $table->integer('main_unit_id');
            $table->integer('sub_unit_id')->nullable();
            $table->decimal('purchase_price', 18, 2)->default(0);
            $table->decimal('sale_price', 18, 2)->default(0);
            $table->json('image')->nullable();
            $table->text('description')->nullable();

            $table->integer('main_unit_stock')->default(0);
            $table->integer('sub_unit_stock')->default(0);
            $table->integer('alert_quantity')->default(0);
            $table->integer('supplier_id')->default(1);
            $table->integer('status')->default(0);
            $table->integer('created_by')->nullable();
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
