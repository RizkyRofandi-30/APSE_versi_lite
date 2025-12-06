<?php

use App\Http\Controllers\AutentikasiController;
use App\Http\Controllers\HealthygateController;
use App\Http\Controllers\MedlicenseController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('index');
});

Route::get('/login', function (Illuminate\Http\Request $request) {
    $source = $request->query('source');   // may be null
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

Route::get('/userHealthygate', [HealthygateController::class, 'showHealthygate'])
    ->name('userHealthygate');

Route::get('/userMedlicense', [MedlicenseController::class, 'showMedlicense'])
    ->name('userMedlicense');


Route::get('/admin-ptsp-medlicense', function () {
    return view('ptsp.admin-ptsp.medlicense');
})->name('admin-ptspMedlicense');

Route::get('/admin-ptsp-healthygate', function () {
    return view('ptsp.admin-ptsp.healthygate');
})->name('admin-ptspHealthygate');

Route::get('/kepala-ptsp-medlicense', function () {
    return view('ptsp.admin-ptsp.medlicense');
})->name('kepala-ptspMedlicense');

Route::get('/kepala-ptsp-healthygate', function () {
    return view('ptsp.kepala-ptsp.healthygate');
})->name('kepala-ptspHealthygate');

Route::get('/dinkesMedlicense', function () {
    return view('dinkes.medlicense');
})->name('dinkesMedlicense');

Route::get('/dinkesHealthygate', function () {
    return view('dinkes.healthygate');
})->name('dinkesHealthygate');


Route::get('/test', function () {
    return view('ptsp.kepala-ptsp.medlicense');
});

Route::get('/formPermohonanMedlicense', function () {
    return view('medlicense.form-permohonan');
});

Route::post('/formPermohonanMedlicense', [MedlicenseController::class, 'permohonan'])->name('postPermohonanMedlicense');

Route::get('/formPermohonanHealthygate', function () {
    return view('healthygate.form-permohonan');
});

Route::post('/formPermohonanHealthygate', [HealthygateController::class, 'permohonan'])->name('postPermohonanHealthygate');

Route::post('/formPerpanjanganHealthygate', [HealthygateController::class, 'perpanjangan'])->name('postPerpanjanganHealthygate');

Route::post('/formPerpanjanganMedlicense', [MedlicenseController::class, 'perpanjangan'])->name('postPerpanjanganMedlicense');



