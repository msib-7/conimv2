<?php

use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/masuk', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/masuk', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/keluar', [App\Http\Controllers\Auth\HrisController::class, 'logout'])->name('logout');

Route::redirect('/', '/masuk');

// Route Login HRIS
Route::get('/loginnya', [App\Http\Controllers\Auth\HrisController::class, 'index']);
Route::post('/loginHris', [App\Http\Controllers\Auth\HrisController::class, 'store'])->name('loginHris');

Route::prefix('v1')->name('v1.')->middleware(['auth', 'CheckJobLvlPermission'])->group(function () {
    Route::get('', [App\Http\Controllers\V1\DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('Suggestion-System')->name('ss.')->group(function () {
        Route::get('', [App\Http\Controllers\V1\SuggestionSystemController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\V1\SuggestionSystemController::class, 'create'])->name('create');
        Route::get('update/{id}', [App\Http\Controllers\V1\SuggestionSystemController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [App\Http\Controllers\V1\SuggestionSystemController::class, 'update'])->name('update');
        Route::delete('update/{id}', [App\Http\Controllers\V1\SuggestionSystemController::class, 'destroy'])->name('destroy');
        Route::get('searchMachine', [App\Http\Controllers\V1\SuggestionSystemController::class, 'machine'])->name('machine');
        Route::post('create', [App\Http\Controllers\V1\SuggestionSystemController::class, 'store'])->name('store');
    });

    Route::prefix('OnesheetReport')->name('osr.')->group(function () {
        Route::get('', [App\Http\Controllers\V1\OneSheetReportController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\V1\OneSheetReportController::class, 'create'])->name('create');
        Route::post('create', [App\Http\Controllers\V1\OneSheetReportController::class, 'store'])->name('store');
        Route::get('searchMachine', [App\Http\Controllers\V1\OneSheetReportController::class, 'machine'])->name('machine');
        Route::get('show/{id}', [App\Http\Controllers\V1\OneSheetReportController::class, 'edit'])->name('edit');
        Route::post('show/{id}', [App\Http\Controllers\V1\OneSheetReportController::class, 'update'])->name('update');
        Route::delete('show/{id}', [App\Http\Controllers\V1\OneSheetReportController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('CostSavingReport')->name('csr.')->group(function () {
        Route::get('', [App\Http\Controllers\V1\CostSavingReportController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\V1\CostSavingReportController::class, 'create'])->name('create');
        Route::get('update/{id}', [App\Http\Controllers\V1\CostSavingReportController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [App\Http\Controllers\V1\CostSavingReportController::class, 'update'])->name('update');
        Route::delete('update/{id}', [App\Http\Controllers\V1\CostSavingReportController::class, 'destroy'])->name('destroy');
        Route::post('create', [App\Http\Controllers\V1\CostSavingReportController::class, 'store'])->name('store');
    });

    Route::prefix('MpInfo')->name('mpinfo.')->group(function () {
        Route::get('', [App\Http\Controllers\V1\MpInfoController::class, 'index'])->name('index');
        Route::get('show/{id}', [App\Http\Controllers\V1\MpInfoController::class, 'show'])->name('show');
        Route::delete('show/{id}', [App\Http\Controllers\V1\MpInfoController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('QualityCircleProject')->name('qcp.')->group(function () {
        Route::get('', [App\Http\Controllers\V1\QualityCircleProjectController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\V1\QualityCircleProjectController::class, 'create'])->name('create');
        Route::get('create/getEmployee', [App\Http\Controllers\V1\QualityCircleProjectController::class, 'hrisGetEmployee'])->name('hrisGetEmployee');
        Route::get('update/{id}', [App\Http\Controllers\V1\QualityCircleProjectController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [App\Http\Controllers\V1\QualityCircleProjectController::class, 'update'])->name('update');
        Route::delete('update/{id}', [App\Http\Controllers\V1\QualityCircleProjectController::class, 'destroy'])->name('destroy');
        Route::post('create', [App\Http\Controllers\V1\QualityCircleProjectController::class, 'store'])->name('store');
    });

    Route::prefix('QualityCircleControl')->name('qcc.')->group(function () {
        Route::get('', [App\Http\Controllers\V1\QualityCircleControlController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\V1\QualityCircleControlController::class, 'create'])->name('create');
        Route::post('create', [App\Http\Controllers\V1\QualityCircleControlController::class, 'store'])->name('store');

        Route::get('create/employee', [App\Http\Controllers\V1\QualityCircleControlController::class, 'hrisGetEmployee'])->name('hrisGetEmployee');
        Route::get('update/{id}', [App\Http\Controllers\V1\QualityCircleControlController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [App\Http\Controllers\V1\QualityCircleControlController::class, 'update'])->name('update');
        Route::delete('update/{id}', [App\Http\Controllers\V1\QualityCircleControlController::class, 'destroy'])->name('destroy');

        Route::prefix('progress')->name('progress.')->group(function () {
            Route::get('{id}', [App\Http\Controllers\V1\QCC\ProgressController::class, 'index'])->name('index');
            Route::post('{id}', [App\Http\Controllers\V1\QCC\ProgressController::class, 'store'])->name('store');
            Route::delete('{id}', [App\Http\Controllers\V1\QCC\ProgressController::class, 'destroy'])->name('destroy');
        });
        // Route::get('progress/{id}', [App\Http\Controllers\V1\QualityCircleControlController::class, 'progres'])->name('progres');
        // Route::get('progress/{id}/create', [App\Http\Controllers\V1\QualityCircleControlController::class, 'progresCreate'])->name('progresCreate');
    });

    Route::prefix('approval')->name('approval.')->group(function () {
        Route::prefix('fasilitator')->name('fasilitator.')->group(function () {
            Route::prefix('suggestion-System')->name('suggestion_System.')->group(function () {
                Route::get('', [App\Http\Controllers\Approval\Fasilitator\SuggestionSystemController::class, 'index'])->name('index');
                Route::get('{id}', [App\Http\Controllers\Approval\Fasilitator\SuggestionSystemController::class, 'show'])->name('show');
                Route::post('{id}', [App\Http\Controllers\Approval\Fasilitator\SuggestionSystemController::class, 'store'])->name('store');
            });

            Route::prefix('oneSheetReport')->name('osr.')->group(function () {
                Route::get('', [App\Http\Controllers\Approval\Fasilitator\OneSheetReportControlller::class, 'index'])->name('index');
                Route::get('{id}', [App\Http\Controllers\Approval\Fasilitator\OneSheetReportControlller::class, 'show'])->name('show');
                Route::post('{id}', [App\Http\Controllers\Approval\Fasilitator\OneSheetReportControlller::class, 'store'])->name('store');
            });

            Route::prefix('costsavingreport')->name('csr.')->group(function () {
                Route::get('', [App\Http\Controllers\Approval\Fasilitator\CostSavingReportController::class, 'index'])->name('index');
                Route::get('{id}', [App\Http\Controllers\Approval\Fasilitator\CostSavingReportController::class, 'show'])->name('show');
                Route::post('{id}', [App\Http\Controllers\Approval\Fasilitator\CostSavingReportController::class, 'store'])->name('store');
            });

            Route::prefix('qualityCircleProject')->name('qcp.')->group(function () {
                Route::get('', [App\Http\Controllers\Approval\Fasilitator\QualityCircleProjectController::class, 'index'])->name('index');
                Route::get('{id}', [App\Http\Controllers\Approval\Fasilitator\QualityCircleProjectController::class, 'show'])->name('show');
                Route::post('{id}', [App\Http\Controllers\Approval\Fasilitator\QualityCircleProjectController::class, 'store'])->name('store');
            });
        });
    });

    Route::prefix('mstdOfficer')->name('mstdOfficer.')->middleware('CheckUserMstdOfficer')->group(function () {
        Route::prefix('suggestionSystem')->name('suggestionSystem.')->group(function () {
            Route::get('', [App\Http\Controllers\Approval\MstdOfficer\SuggestionSystemController::class, 'index'])->name('index');
            Route::get('{id}', [App\Http\Controllers\Approval\MstdOfficer\SuggestionSystemController::class, 'show'])->name('show');
            Route::post('{id}', [App\Http\Controllers\Approval\MstdOfficer\SuggestionSystemController::class, 'store'])->name('store');
        });
        Route::prefix('costSavingReport')->name('csr.')->group(function () {
            Route::get('', [App\Http\Controllers\Approval\MstdOfficer\CostSavingReportController::class, 'index'])->name('index');
            Route::get('{id}', [App\Http\Controllers\Approval\MstdOfficer\CostSavingReportController::class, 'show'])->name('show');
            Route::post('{id}', [App\Http\Controllers\Approval\MstdOfficer\CostSavingReportController::class, 'store'])->name('store');
        });
        Route::prefix('qualityCircleProject')->name('qcp.')->group(function () {
            Route::get('', [App\Http\Controllers\Approval\MstdOfficer\QualityCircleProjectController::class, 'index'])->name('index');
            Route::get('{id}', [App\Http\Controllers\Approval\MstdOfficer\QualityCircleProjectController::class, 'show'])->name('show');
            Route::post('{id}', [App\Http\Controllers\Approval\MstdOfficer\QualityCircleProjectController::class, 'store'])->name('store');
        });

        Route::prefix('oneSheetReport')->name('osr.')->group(function () {
            Route::get('', [App\Http\Controllers\Approval\MstdOfficer\OneSheetReportController::class, 'index'])->name('index');
            Route::get('{id}', [App\Http\Controllers\Approval\MstdOfficer\OneSheetReportController::class, 'show'])->name('show');
            Route::post('{id}', [App\Http\Controllers\Approval\MstdOfficer\OneSheetReportController::class, 'store'])->name('store');
        });
    });

    Route::prefix('mstdSpv')->name('mstdSpv.')->middleware('CheckUserMstdSpv')->group(function () {
        Route::prefix('suggestionSystem')->name('suggestionSystem.')->group(function () {
            Route::get('', [App\Http\Controllers\Approval\MstdSpv\SuggestionSystemController::class, 'index'])->name('index');
            Route::get('{id}', [App\Http\Controllers\Approval\MstdSpv\SuggestionSystemController::class, 'show'])->name('show');
            Route::post('{id}', [App\Http\Controllers\Approval\MstdSpv\SuggestionSystemController::class, 'store'])->name('store');
        });

        Route::prefix('costSavingReport')->name('costSavingReport.')->group(function () {
            Route::get('', [App\Http\Controllers\Approval\MstdSpv\CostSavingReportController::class, 'index'])->name('index');
            Route::get('{id}', [App\Http\Controllers\Approval\MstdSpv\CostSavingReportController::class, 'show'])->name('show');
            Route::post('{id}', [App\Http\Controllers\Approval\MstdSpv\CostSavingReportController::class, 'store'])->name('store');
        });

        Route::prefix('qualityCircleProject')->name('qcp.')->group(function () {
            Route::get('', [App\Http\Controllers\Approval\MstdSpv\QualityCircleProjectController::class, 'index'])->name('index');
            Route::get('{id}', [App\Http\Controllers\Approval\MstdSpv\QualityCircleProjectController::class, 'show'])->name('show');
            Route::post('{id}', [App\Http\Controllers\Approval\MstdSpv\QualityCircleProjectController::class, 'store'])->name('store');
        });

        Route::prefix('oneSheetReport')->name('osr.')->group(function () {
            Route::get('', [App\Http\Controllers\Approval\MstdSpv\OneSheetReportController::class, 'index'])->name('index');
            Route::get('{id}', [App\Http\Controllers\Approval\MstdSpv\OneSheetReportController::class, 'show'])->name('show');
            Route::post('{id}', [App\Http\Controllers\Approval\MstdSpv\OneSheetReportController::class, 'store'])->name('store');
        });
    });
    Route::prefix('financeAccounting')->name('financeAccounting.')->middleware('CheckUserFa')->group(function () {
        Route::prefix('suggestionSystem')->name('suggestionSystem.')->group(function () {
            Route::get('', [App\Http\Controllers\Approval\FinanceAccounting\SuggestionSystemController::class, 'index'])->name('index');
            Route::get('{id}', [App\Http\Controllers\Approval\FinanceAccounting\SuggestionSystemController::class, 'show'])->name('show');
            Route::post('{id}', [App\Http\Controllers\Approval\FinanceAccounting\SuggestionSystemController::class, 'store'])->name('store');
        });
        Route::prefix('costSavingReport')->name('costSavingReport.')->group(function () {
            Route::get('', [App\Http\Controllers\Approval\FinanceAccounting\CostSavingReportController::class, 'index'])->name('index');
            Route::get('{id}', [App\Http\Controllers\Approval\FinanceAccounting\CostSavingReportController::class, 'show'])->name('show');
            Route::post('{id}', [App\Http\Controllers\Approval\FinanceAccounting\CostSavingReportController::class, 'store'])->name('store');
        });
        Route::prefix('qualityCircleProject')->name('qcp.')->group(function () {
            Route::get('', [App\Http\Controllers\Approval\FinanceAccounting\QualityCircleProjectController::class, 'index'])->name('index');
            Route::get('{id}', [App\Http\Controllers\Approval\FinanceAccounting\QualityCircleProjectController::class, 'show'])->name('show');
            Route::post('{id}', [App\Http\Controllers\Approval\FinanceAccounting\QualityCircleProjectController::class, 'store'])->name('store');
        });
        Route::prefix('oneSheetReport')->name('osr.')->group(function () {
            Route::get('', [App\Http\Controllers\Approval\FinanceAccounting\OneSheetReportController::class, 'index'])->name('index');
            Route::get('{id}', [App\Http\Controllers\Approval\FinanceAccounting\OneSheetReportController::class, 'show'])->name('show');
            Route::post('{id}', [App\Http\Controllers\Approval\FinanceAccounting\OneSheetReportController::class, 'store'])->name('store');
        });
    });
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'CheckJobLvlPermission'])->group(function () {
    Route::get('', [App\Http\Controllers\V1\DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('notify')->name('notify.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('index');
        Route::post('', [App\Http\Controllers\Admin\NotificationController::class, 'store'])->name('store');
    });

    Route::prefix('permission')->name('permission.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\Admin\PermissionController::class, 'create'])->name('create');
        Route::post('create', [App\Http\Controllers\Admin\PermissionController::class, 'store'])->name('store');
        Route::get('show/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'show'])->name('show');
        Route::post('show/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('update');
        Route::delete('show/{id}', [App\Http\Controllers\Admin\PermissionController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\MenuController::class, 'index'])->name('index');
        Route::post('', [App\Http\Controllers\Admin\MenuController::class, 'store'])->name('store');
        Route::delete('show/{id}', [App\Http\Controllers\Admin\MenuController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('category')->name('category.')->group(function () {
        Route::prefix('corp')->name('corp.')->group(function () {
            Route::get('', [App\Http\Controllers\Admin\Category\CategoryCorpController::class, 'index'])->name('index');
            Route::post('', [App\Http\Controllers\Admin\Category\CategoryCorpController::class, 'store'])->name('store');
            Route::post('import', [App\Http\Controllers\Admin\Category\CategoryCorpController::class, 'importExcel'])->name('importExcel');
            Route::get('show/{id}', [App\Http\Controllers\Admin\Category\CategoryCorpController::class, 'show'])->name('show');
            Route::post('show/{id}', [App\Http\Controllers\Admin\Category\CategoryCorpController::class, 'update'])->name('update');
            Route::delete('show/{id}', [App\Http\Controllers\Admin\Category\CategoryCorpController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('costSaving')->name('costSaving.')->group(function () {
            Route::get('', [App\Http\Controllers\Admin\Category\CostSavingController::class, 'index'])->name('index');
            Route::post('', [App\Http\Controllers\Admin\Category\CostSavingController::class, 'store'])->name('store');
            Route::post('import', [App\Http\Controllers\Admin\Category\CostSavingController::class, 'importExcel'])->name('importExcel');
            Route::get('show/{id}', [App\Http\Controllers\Admin\Category\CostSavingController::class, 'show'])->name('show');
            Route::post('show/{id}', [App\Http\Controllers\Admin\Category\CostSavingController::class, 'update'])->name('update');
            Route::delete('show/{id}', [App\Http\Controllers\Admin\Category\CostSavingController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('jenisSaving')->name('jenisSaving.')->group(function () {
            Route::get('', [App\Http\Controllers\Admin\Category\JenisSavingController::class, 'index'])->name('index');
            Route::post('', [App\Http\Controllers\Admin\Category\JenisSavingController::class, 'store'])->name('store');
            Route::get('show/{id}', [App\Http\Controllers\Admin\Category\JenisSavingController::class, 'show'])->name('show');
            Route::post('show/{id}', [App\Http\Controllers\Admin\Category\JenisSavingController::class, 'update'])->name('update');
            Route::delete('show/{id}', [App\Http\Controllers\Admin\Category\JenisSavingController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('improvment')->name('improvment.')->group(function () {
            Route::get('', [App\Http\Controllers\Admin\Category\CategoryImprovmentController::class, 'index'])->name('index');
            Route::post('', [App\Http\Controllers\Admin\Category\CategoryImprovmentController::class, 'store'])->name('store');
            Route::post('import', [App\Http\Controllers\Admin\Category\CategoryImprovmentController::class, 'importExcel'])->name('importExcel');
            Route::get('show/{id}', [App\Http\Controllers\Admin\Category\CategoryImprovmentController::class, 'show'])->name('show');
            Route::post('show/{id}', [App\Http\Controllers\Admin\Category\CategoryImprovmentController::class, 'update'])->name('update');
            Route::delete('show/{id}', [App\Http\Controllers\Admin\Category\CategoryImprovmentController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('impactTo')->name('impactTo.')->group(function () {
            Route::get('', [App\Http\Controllers\Admin\Category\CategoryImpactController::class, 'index'])->name('index');
            Route::post('', [App\Http\Controllers\Admin\Category\CategoryImpactController::class, 'store'])->name('store');
            Route::post('import', [App\Http\Controllers\Admin\Category\CategoryImpactController::class, 'importExcel'])->name('importExcel');
            Route::get('show/{id}', [App\Http\Controllers\Admin\Category\CategoryImpactController::class, 'show'])->name('show');
            Route::post('show/{id}', [App\Http\Controllers\Admin\Category\CategoryImpactController::class, 'update'])->name('update');
            Route::delete('show/{id}', [App\Http\Controllers\Admin\Category\CategoryImpactController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::prefix('fa')->name('FA.')->group(function () {
            Route::get('', [App\Http\Controllers\Admin\Users\FaController::class, 'index'])->name('index');
            Route::get('getHrisEmployee', [App\Http\Controllers\Admin\Users\FaController::class, 'hrisGetEmployee'])->name('getHrisEmployee');
            Route::post('', [App\Http\Controllers\Admin\Users\FaController::class, 'store'])->name('store');
            Route::delete('{id}', [App\Http\Controllers\Admin\Users\FaController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('mstdOfficer')->name('mstdOfficer.')->group(function () {
            Route::get('', [App\Http\Controllers\Admin\Users\MstdOfficerController::class, 'index'])->name('index');
            Route::get('getHrisEmployee', [App\Http\Controllers\Admin\Users\MstdOfficerController::class, 'hrisGetEmployee'])->name('getHrisEmployee');
            Route::post('', [App\Http\Controllers\Admin\Users\MstdOfficerController::class, 'store'])->name('store');
            Route::delete('{id}', [App\Http\Controllers\Admin\Users\MstdOfficerController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('mstdSpv')->name('mstdSpv.')->group(function () {
            Route::get('', [App\Http\Controllers\Admin\Users\MstdSpvController::class, 'index'])->name('index');
            Route::get('getHrisEmployee', [App\Http\Controllers\Admin\Users\MstdSpvController::class, 'hrisGetEmployee'])->name('getHrisEmployee');
            Route::post('', [App\Http\Controllers\Admin\Users\MstdSpvController::class, 'store'])->name('store');
            Route::delete('{id}', [App\Http\Controllers\Admin\Users\MstdSpvController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('masterMachine')->name('masterMachine.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\MachineController::class, 'index'])->name('index');
        Route::post('', [App\Http\Controllers\Admin\MachineController::class, 'store'])->name('store');
        Route::post('import', [App\Http\Controllers\Admin\MachineController::class, 'importExcel'])->name('importExcel');
        Route::get('{id}', [App\Http\Controllers\Admin\MachineController::class, 'show'])->name('show');
        Route::delete('{id}', [App\Http\Controllers\Admin\MachineController::class, 'destroy'])->name('destroy');
    });
});
