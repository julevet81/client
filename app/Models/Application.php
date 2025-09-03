<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'account_id',
        'upload_date',
        'start_test_date',
        'end_test_date',
        'acceptation_date',
        'status',
        'testers',
    ];

    protected $casts = [
        'testers'=> 'array',
    ];

    public function testers()
    {
        return $this->belongsToMany(Tester::class, 'application_tester');
    }

    
}
