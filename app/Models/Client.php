<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * Get the account that owns the client.
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get the subscriptions associated with the client.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
