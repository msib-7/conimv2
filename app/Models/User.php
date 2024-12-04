<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\System\AuditTrail;
use App\Models\System\Menu;
use App\Models\System\Notification;
use App\Models\System\Permission;
use App\Models\System\Role;
use App\Models\System\RoleUser;
use App\Models\System\UserFa;
use App\Models\System\UserMstdOfficer;
use App\Models\System\UserMstdSpv;
use App\Services\System\GetFasilitatorService;
use App\Traits\AuditTrailable;
use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUIDAsPrimaryKey, AuditTrailable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'result'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
        'result' => 'array'
    ];

    public function auditTrails()
    {
        return $this->hasMany(AuditTrail::class, 'model_id')->where('model', User::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function notify()
    {
        return $this->notifications()->orderBy('created_at', 'desc')->get();
    }

    public function isUserFa()
    {
        return UserFa::where('nik', $this->employeId)->exists();
    }

    public function isMstdOfficer()
    {
        return UserMstdOfficer::where('nik', $this->employeId)->exists();
    }

    public function isMstdSpv()
    {
        return UserMstdSpv::where('nik', $this->employeId)->exists();
    }

    public function roles()
    {
        return $this->belongsTo(Role::class, 'jobLvl', 'name');
    }

    public function getFasilitator($nik)
    {
        return (new GetFasilitatorService)->handle($nik);
    }

    public function layout()
    {
        // Ambil semua menu terlebih dahulu
        return Menu::whereNull('parent_id') // Ambil menu utama
            ->with(['children' => function ($query) {
                $query->whereJsonContains(
                    'jobLvl',
                    $this->jobLvl
                ); // Ambil sub-menu sesuai jobTitle
            }])
            ->orderBy('order', 'DESC') // Urutkan menu utama
            ->get();
    }
}
