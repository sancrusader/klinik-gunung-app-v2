<?php

use App\Http\Controllers\KasirController;
use App\Http\Controllers\KoordinatorPenyelamatController;
use App\Http\Controllers\ManajerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParamedisController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\ConsultationController;


// Page

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('about', function () {
    return view('pages.about', ['title' => 'About Us']);
})->name('about');


Route::get('blog', function () {
    return view('pages.blog', ['title' => 'Blog']);
})->name('blog');

Route::get('services', function () {
    return view('pages.services', ['title' => 'Services']);
})->name('services');


Route::get('contact', function () {
    return view('pages.contact', ['title' => 'Contact']);
})->name('contact');

Route::get('products', function () {
    return view('pages.products', ['title' => 'Products']);
})->name('products');

// !End Page


// Auth 

Route::get('/login', function () {
    return view('auth.login', ['title' => 'Login']);
})->middleware('guest')->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('auth.register', ['title' => 'Register']);
})->middleware('guest')->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// !End Auth




// Verification Email

Route::get('email/verify/{id}/{hash}', [AuthController::class, 'verify'])
    ->name('verification.verify')
    ->middleware(['signed', 'throttle:6,1']);
Route::post('email/resend', [AuthController::class, 'resend'])->name('verification.resend');
Route::get('verify-email', function () {
    return view('auth.verify-email');
})->name('verify.email');


// !End Verification Email 



// Dashboard

Route::middleware(['auth'])->group(function () {

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.welcome');

        Route::get('/admin/scan', function () {
            return view('admin.scan');
        })->name('admin.scan');

        Route::post('/admin/scan/process', [AdminController::class, 'scanQr'])->name('admin.scan.process');

        Route::post('/admin/store-user', [AdminController::class, 'storeUser'])->name('admin.storeUser');
        Route::get('/admin/users', [AdminController::class, 'createUser'])->name('admin.createUser');
        Route::get('/admin/pendaki', [UserController::class, 'showPendaki'])->name('showPendaki');
        Route::get('/admin/admin', [UserController::class, 'showAdmin'])->name('showAdmin');
        Route::get('/admin/kasir', [UserController::class, 'showKasir'])->name('showKasir');
        Route::get('/admin/perawat', [UserController::class, 'showParamedis'])->name('showParamedis');
        Route::get('/admin/dokter', [UserController::class, 'showDokter'])->name('showDokter');
        Route::get('/admin/manajer', [UserController::class, 'showManajer'])->name('showManajer');
        Route::get('/admin/koordinator-penyelamat', [UserController::class, 'showkoordinatorPenyelamat'])->name('showKoordinatorPenyelamat');
    });

    Route::middleware(['auth', 'role:pendaki'])->group(function () {
        Route::get('/pendaki/dashboard', [PatientController::class, 'index'])->name('pendaki.welcome');

        Route::get('pendaki/screenings', [ScreeningController::class, 'index'])->name('pendaki.screening')->middleware('auth');
        Route::get('/screenings/create', [ScreeningController::class, 'create'])->name('screenings.create');
        Route::get('/pendaki/consultasi', [ConsultationController::class, 'hikerIndex'])->name('pendaki.consultasi.index');
        Route::post('/pendaki/consultasi', [ConsultationController::class, 'store'])->name('pendaki.consultasi.store');
        Route::post('/screenings', [ScreeningController::class, 'store'])->name('screenings.store');
        Route::get('/screenings/{id}/payment', [ScreeningController::class, 'payment'])->name('screenings.payment');
        Route::post('/payment-callback', [ScreeningController::class, 'paymentCallback'])->name('payment.callback');
        // Rute untuk menampilkan jadwal yang belum memiliki konsultasi
        Route::get('pendaki/consultasi-schedule', [ConsultationController::class, 'createSchedule'])->name('pendaki.create_schedule');

    });

    Route::middleware(['role:dokter'])->group(function () {
        Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.welcome');
        Route::get('/dokter/consultasi', [ConsultationController::class, 'doctorIndex'])->name('dokter.consultasi.index');
        Route::post('/dokter/consultasi/{consultation}/complete', [ConsultationController::class, 'complete'])->name('dokter.consultasi.complete');

        // Rute untuk menampilkan jadwal konsultasi dokter
        Route::get('dokter/jadwal', [ConsultationController::class, 'doctorSchedule'])->name('dokter.schedule');
        // Rute untuk menyelesaikan konsultasi
        Route::patch('dokter/consultations/{consultation}/complete', [ConsultationController::class, 'ScheduleComplete'])->name('dokter.complete');


    });

    Route::middleware(['role:paramedis'])->group(function () {
        Route::get('/paramedis/dashboard', [ParamedisController::class, 'index'])->name('paramedis.welcome');
        Route::get('/paramedis/screening', [ParamedisController::class, 'dashboard'])->name('paramedis.dashboard');
        Route::post('/paramedis/health-check/{id}', [ParamedisController::class, 'processHealthCheck'])->name('paramedis.process');
        Route::get('/paramedis/data', [ParamedisController::class, 'dashboard'])->name('paramedis.data');
    });

    Route::middleware(['role:koordinator'])->group(function () {
        Route::get('/koordinator/dashboard', [KoordinatorPenyelamatController::class, 'index'])->name('koordinator.welcome');
    });

    Route::middleware(['role:manajer'])->group(function () {
        Route::get('/manajer/dashboard', [ManajerController::class, 'index'])->name('manajer.welcome');
    });

    Route::middleware(['role:kasir'])->group(function () {
        Route::get('/kasir/dashboard', [KasirController::class, 'index'])->name('kasir.welcome');
    });


    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');
    Route::get('/profile/password', [ProfileController::class, 'showPasswordForm'])->name('profile.showPasswordForm');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');


    Route::middleware(['auth'])->group(function () {
        Route::get('/screenings/create', [ScreeningController::class, 'create'])->name('screenings.create');
        Route::post('/screenings', [ScreeningController::class, 'store'])->name('screenings.store');
        Route::get('/screenings', [ScreeningController::class, 'index'])->name('screenings.index');
    });


});

// Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');





