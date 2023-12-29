<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellLog extends Model
{
    use HasFactory;

    public function sellingInfo()
    {
        return $this->belongsTo(SellingInfo::class);
    }
}
