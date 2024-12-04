<?php

namespace App\Models\System;

use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgressQualityCircleControl extends Model
{
    use HasFactory, UUIDAsPrimaryKey, AuditTrailable;
    protected $guarded;

    public function statusApproval()
    {
        return $this->belongsTo(StatusApproval::class, 'approval', 'code');
    }
}
