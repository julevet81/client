<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'account_id',
        'client_id',
        'status_id',
        'publication_date',
        'email',
        'publication_price',
        'weekly_price',
        'update_price',
        'upload_price',
    ];

    /**
     * Get the account that owns the subscription.
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get the client that owns the subscription.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the status of the subscription.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
