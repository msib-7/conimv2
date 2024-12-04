<?php

namespace App\Models\System;

use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MpInfo extends Model
{
    use HasFactory, UUIDAsPrimaryKey, AuditTrailable;
    protected $guarded;
}
