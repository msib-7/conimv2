<?php

namespace App\Models\System;

use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusApproval extends Model
{
    use HasFactory, UUIDAsPrimaryKey, AuditTrailable;
    use SoftDeletes;

    protected $guarded;
}
