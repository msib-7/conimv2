<?php

namespace App\Models\System;

use App\Models\User;
use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneSheetReport extends Model
{
    use HasFactory, UUIDAsPrimaryKey, AuditTrailable;
    protected $guarded;

    public function statusApproval()
    {
        return $this->belongsTo(StatusApproval::class, 'approval', 'code');
    }

    public function history()
    {
        return $this->hasOne(HistoryOneSheetReport::class)->latest();
    }

    public function mesin()
    {
        return $this->belongsTo(Mesin::class, 'mesin_id', 'id');
    }

    public function pemohon()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
