<?php

namespace App\Models\System;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = ['model', 'model_id', 'action', 'old_data', 'new_data', 'user_id'];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];
}
