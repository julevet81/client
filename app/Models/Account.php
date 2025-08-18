<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'publication_price',
        'weekly_price',
        'update_price',
    ];

    /**
     * Get the clients associated with the account.
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * Get the subscriptions associated with the account.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
