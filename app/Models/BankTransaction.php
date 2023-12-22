<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_type',
        'amount',
        'to_bank_account_id',
        'from_bank_account_id',
        'income_source_id',
        'expense_category_id',
        'invoice_id',
        'purchase_id',
        'reference_no',
        'title',
        'details',
        'payment_method_id',
        'status',
        'attachment',
        'created_by',
    ];

    public function to_bank_account()
    {
        return $this->belongsTo(BankAccount::class, 'to_bank_account_id');
    }

    public function from_bank_account()
    {
        return $this->belongsTo(BankAccount::class, 'from_bank_account_id');
    }

    public function income_source()
    {
        return $this->belongsTo(IncomeSource::class, 'income_source_id');
    }

    public function expense_category()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
