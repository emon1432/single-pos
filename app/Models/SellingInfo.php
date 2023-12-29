<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellingInfo extends Model
{
    use HasFactory;

    public function sellingItems()
    {
        return $this->hasMany(SellingItem::class);
    }

    public function sellingPrice()
    {
        return $this->hasOne(SellingPrice::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class)->select('id', 'name', 'phone', 'email', 'address');
    }

    //created by
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->select('id', 'name');
    }

}
