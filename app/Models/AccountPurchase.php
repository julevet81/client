<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'account_id',
        'price',
    ];

    


}
