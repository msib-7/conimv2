<?php

namespace App\Models\System;

use App\Models\User;
use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityCircleControl extends Model
{
    use HasFactory, UUIDAsPrimaryKey, AuditTrailable;
    protected $guarded;

    public function statusApproval()
    {
        return $this->belongsTo(StatusApproval::class, 'approval', 'code');
    }

    public function history()
    {
        // return $this->hasOne(HistoryCostSavingReport::class)->latestOfMany();
        return null;
    }

    public function pemohon()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function teams()
    {
        return $this->hasMany(TeamQualityCircleControl::class, 'quality_circle_control_id', 'id');
    }
}
