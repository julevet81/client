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
        'owner_name',
        'device_id',
        'email',
        'phone',
        'publication_price',
        'weekly_price',
        'update_price',
        'upload_price',
        'price',
        'open_date',
        'activation_date',
        'is_sold'
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

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class, 'account_purchase')
                ->withPivot('price')
                ->withTimestamps();
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

}