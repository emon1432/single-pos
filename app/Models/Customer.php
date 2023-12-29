<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function filter($request)
    {
        $query = $this->newQuery();
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('email') && $request->email != '') {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->has('phone') && $request->phone != '') {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }
        if ($request->has('address') && $request->address != '') {
            $query->where('address', 'like', '%' . $request->address . '%');
        }
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        return $query;

    }
}
