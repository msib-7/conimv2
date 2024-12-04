<?php

namespace App\Models\System;

use App\Models\User;
use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostSavingReport extends Model
{
    use HasFactory, UUIDAsPrimaryKey, AuditTrailable, SoftDeletes;
    protected $guarded;

    public function statusApproval()
    {
        return $this->belongsTo(StatusApproval::class, 'approval', 'code');
    }

    public function history()
    {
        return $this->hasOne(HistoryCostSavingReport::class)->latest();
    }

    public function pemohon()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
