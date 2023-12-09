<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

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

    //purchase items relation
    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class, 'purchase_id', 'id');
    }

    //purchase logs relation
    public function purchaseLogs()
    {
        return $this->hasMany(PurchaseLog::class, 'purchase_id', 'id');
    }
}
