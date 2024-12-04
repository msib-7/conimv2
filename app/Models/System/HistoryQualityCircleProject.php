<?php

namespace App\Models\System;

use App\Models\User;
use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryQualityCircleProject extends Model
{
    use HasFactory, UUIDAsPrimaryKey, AuditTrailable;
    protected $guarded;

    public function qualitycircleproject()
    {
        return $this->belongsTo(QualityCircleProject::class, 'quality_circle_project_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function statusApproval()
    {
        return $this->belongsTo(StatusApproval::class, 'status', 'code');
    }
}
