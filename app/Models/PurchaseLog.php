<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseLog extends Model
{
    use HasFactory;

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    //supplier relation
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    //user who created this purchase
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
