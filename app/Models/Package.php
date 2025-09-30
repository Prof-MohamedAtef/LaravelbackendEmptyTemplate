<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;


      protected $fillable = [
        'name',
        'description',
        'duration',
        'percent',
        'status',
        'expire_at',
    ];

    protected $casts = [
        'status' => 'boolean',
        'expire_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
