<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'total_price',
        'payment_method'
    ];

    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'account_purchase')
                ->withPivot('price')
                ->withTimestamps();
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


}
