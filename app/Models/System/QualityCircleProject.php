<?php

namespace App\Models\System;

use App\Models\User;
use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityCircleProject extends Model
{
    use HasFactory, UUIDAsPrimaryKey, AuditTrailable;
    protected $guarded;

    public function statusApproval()
    {
        return $this->belongsTo(StatusApproval::class, 'approval', 'code');
    }

    public function history()
    {
        return $this->hasOne(HistoryQualityCircleProject::class)->latest();
    }

    public function pemohon()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function team() {
        return $this->hasMany(TeamsQualityCircleProject::class, 'quality_circle_project_id');
    }
}
