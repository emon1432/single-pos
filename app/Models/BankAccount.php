<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'account_number',
        'bank_name',
        'branch_name',
        'branch_address',
        'details',
        'contact_person',
        'contact_number',
        'email',
        'url',
        'created_by',
    ];


    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function bank_transactions()
    {
        return $this->hasMany(BankTransaction::class, 'to_bank_account_id', 'id');
    }
}
