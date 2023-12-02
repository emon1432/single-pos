<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded=[];

    public function related_unit()
    {
        return $this->belongsTo(Unit::class,'related_unit_id');
    }
}
