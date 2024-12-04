<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\System\Permission;
use App\Models\System\Role;
use App\Models\User;
use App\Services\System\ApprovalMailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public function index()
    {
        $topUsersCSR = $this->getTopUsers('cost_saving_reports');
        $topUsersQCP = $this->getTopUsers('quality_circle_projects');
        $topUsersSS = $this->getTopUsers('suggestion_systems');
        $topUsersOSR = $this->getTopUsers('one_sheet_reports');
        // dd($topUsersOSR);
        return view('welcome', compact('topUsersCSR', 'topUsersQCP', 'topUsersSS', 'topUsersOSR'));

        // $message = 'Halo anda baru saja menerima permintaan persetujuan Sugestion System yang telah dibuat oleh ' . auth()->user()->fullname . ' Silahkan lakukan persetujuan segera.';
        // $data = [
        //     'status' => 'Waiting Approval',
        //     'link' => route('v1.dashboard'),
        //     'penerima' => 'Fauzan Taqiyuddin',
        //     'body' => $message
        // ];

        // $response = (new ApprovalMailService)->handle('fauzan.taqiyuddin@kalbe.co.id', $data);
        // dd($response);
    }

    private function getTopUsers($tableName)
    {
        return DB::table($tableName)
            ->select($tableName . '.user_id', 'users.fullname', 'users.groupName', DB::raw('COUNT(*) as total'))
            ->join('users', $tableName . '.user_id', '=', 'users.id')
            ->where($tableName . '.approval', 500)
            ->groupBy($tableName . '.user_id', 'users.fullname', 'users.groupName')
            ->orderBy('total', 'desc')
            ->limit(3)
            ->get();
    }
}
