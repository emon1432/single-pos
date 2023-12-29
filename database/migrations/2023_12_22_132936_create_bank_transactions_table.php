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
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_type');
            $table->double('amount');
            $table->integer('to_bank_account_id')->nullable();
            $table->integer('from_bank_account_id')->nullable();
            $table->integer('income_source_id')->nullable();
            $table->integer('expense_category_id')->nullable();
            $table->integer('sell_info_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->integer('purchase_id')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('title')->nullable();
            $table->string('details')->nullable();
            $table->string('payment_method_id')->nullable();
            $table->string('status')->nullable();
            $table->string('attachment')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_transactions');
    }
};
