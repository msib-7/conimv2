<?php

namespace App\Models\System;

use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class HistoryCostSavingReport extends Model
{
    use HasFactory, UUIDAsPrimaryKey, AuditTrailable;
    protected $guarded;


    public function suggestionsystem()
    {
        return $this->belongsTo(CostSavingReport::class, 'cost_saving_report_id', 'id');
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
