<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tester extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "email",
    ];

    public function application()
    {
        return $this->belongsToMany(Application::class, 'application_tester');
    }



}
