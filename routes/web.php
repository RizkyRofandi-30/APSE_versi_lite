<?php

use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\HealthygateController;
use App\Http\Controllers\AdminMedlicenseController;
use App\Http\Controllers\AdminHealthygateController;
use App\Http\Controllers\MedlicenseController;
use App\Http\Controllers\DinkesMedlicenseController;
use App\Http\Controllers\DinkesHealthygateController;
use App\Http\Controllers\KepalaPtspMedlicenseController;
use App\Http\Controllers\KepalaPtspHealthygateController; 
use Illuminate\Support\Facades\Route;

// =====================
// AUTH + HALAMAN UMUM
// =====================

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function (Illuminate\Http\Request $request) {
    $source = $request->query('source');
    return view('autentikasi.login', compact('source'));
});

Route::post('/login', [AutentikasiController::class, 'login'])->name('postLogin');

Route::get('/register', function (Illuminate\Http\Request $request) {
    $source = $request->query('source');
    return view('autentikasi.register', compact('source'));
});

Route::post('/register', [AutentikasiController::class, 'register'])->name('postRegister');

Route::post('/logout', function () {
    session()->forget('user');
    return redirect('/');
})->name('logout');


// =====================
// USER (PEMOHON)
// =====================

Route::get('/userHealthygate', [HealthygateController::class, 'showHealthygate'])
    ->name('userHealthygate');

Route::get('/userMedlicense', [MedlicenseController::class, 'showMedlicense'])
    ->name('userMedlicense');

Route::get('/formPermohonanMedlicense', function () {
    return view('medlicense.form-permohonan');
});

Route::post('/formPermohonanMedlicense', [MedlicenseController::class, 'permohonan'])
    ->name('postPermohonanMedlicense');

Route::get('/formPermohonanHealthygate', function () {
    return view('healthygate.form-permohonan');
});

Route::post('/formPermohonanHealthygate', [HealthygateController::class, 'permohonan'])
    ->name('postPermohonanHealthygate');

Route::post('/formPerpanjanganHealthygate', [HealthygateController::class, 'perpanjangan'])
    ->name('postPerpanjanganHealthygate');

Route::post('/formPerpanjanganMedlicense', [MedlicenseController::class, 'perpanjangan'])
    ->name('postPerpanjanganMedlicense');


// =====================
// ADMIN PTSP
// =====================

Route::get('/admin-ptsp-medlicense', [AdminMedlicenseController::class, 'index'])
    ->name('admin-ptspMedlicense');

Route::get('/admin-ptsp-healthygate', [AdminHealthygateController::class, 'index'])
    ->name('admin-ptsphealthygate');

Route::post('/ptsp/medlicense/setujui/{id}', 
    [AdminMedlicenseController::class, 'setujui'])
    ->name('ptsp.medlicense.setujui');

Route::post('/ptsp/medlicense/tolak/{id}', 
    [AdminMedlicenseController::class, 'tolak'])
    ->name('ptsp.medlicense.tolak');

Route::post('/ptsp/healthygate/setujui/{id}', 
    [AdminHealthygateController::class, 'setujui'])
    ->name('ptsp.healthygate.setujui');

Route::post('/ptsp/healthygate/tolak/{id}', 
    [AdminHealthygateController::class, 'tolak'])
    ->name('ptsp.healthygate.tolak');


// =====================
// DINKES
// =====================

// MEDLICENSE
Route::get('/dinkesMedlicense', [DinkesMedlicenseController::class, 'index'])
    ->name('dinkesMedlicense');

Route::post('/dinkes/medlicense/setujui/{id}', 
    [DinkesMedlicenseController::class, 'setujui'])
    ->name('dinkes.medlicense.setujui');

Route::post('/dinkes/medlicense/tolak/{id}', 
    [DinkesMedlicenseController::class, 'tolak'])
    ->name('dinkes.medlicense.tolak');

// HEALTHYGATE
Route::get('/dinkesHealthygate', [DinkesHealthygateController::class, 'index'])
    ->name('dinkesHealthygate');

Route::post('/dinkes/healthygate/setujui/{id}', 
    [DinkesHealthygateController::class, 'setujui'])
    ->name('dinkes.healthygate.setujui');

Route::post('/dinkes/healthygate/tolak/{id}', 
    [DinkesHealthygateController::class, 'tolak'])
    ->name('dinkes.healthygate.tolak');


// =====================
// KEPALA PTSP
// =====================

// MEDLICENSE
Route::get('/kepala-ptsp-medlicense', [KepalaPtspMedlicenseController::class, 'index'])
    ->name('kepala-ptspMedlicense');

Route::post('/kepala-ptsp/medlicense/setujui/{id}',
    [KepalaPtspMedlicenseController::class, 'setujui'])
    ->name('kepala-ptsp.medlicense.setujui');

Route::post('/kepala-ptsp/medlicense/tolak/{id}',
    [KepalaPtspMedlicenseController::class, 'tolak'])
    ->name('kepala-ptsp.medlicense.tolak');

// HEALTHYGATE
Route::get('/kepala-ptsp-healthygate', [KepalaPtspHealthygateController::class, 'index'])
    ->name('kepala-ptspHealthygate');

Route::post('/kepala-ptsp/healthygate/setujui/{id}',
    [KepalaPtspHealthygateController::class, 'setujui'])
    ->name('kepala-ptsp.healthygate.setujui');

Route::post('/kepala-ptsp/healthygate/tolak/{id}',
    [KepalaPtspHealthygateController::class, 'tolak'])
    ->name('kepala-ptsp.healthygate.tolak');
