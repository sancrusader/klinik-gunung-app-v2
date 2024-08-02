<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ManajerController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParamedisController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\ScreeningOfflineController;
use App\Http\Controllers\KoordinatorPenyelamatController;

// Page

// Home Page
Route::get('/', function () {
    return view('welcome');
})->name('/');

// About Page
Route::get('about', function () {
    return view('pages.about', ['title' => 'About Us']);
})->name('about');


// Blog Page
Route::get('blog', function () {
    return view('pages.blog', ['title' => 'Blog']);
})->name('blog');

// Services Page
Route::get('services', function () {
    return view('pages.services', ['title' => 'Services']);
})->name('services');


// Contact Page
Route::get('contact', function () {
    return view('pages.contact', ['title' => 'Contact']);
})->name('contact');


// Products Page
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

    // Role Admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.welcome');

        Route::get('/admin/scan', function () {
            return view('admin.scan');
        })->name('admin.scan');

        Route::post('/admin/scan/process', [AdminController::class, 'scanQr'])->name('admin.scan.process');

        // Table Users
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

    // Role Pendaki
    Route::middleware(['auth', 'role:pendaki'])->group(function () {
        Route::get('/pendaki/dashboard', [PatientController::class, 'index'])->name('pendaki.welcome');
        Route::get('/pendaki/consultasi', [ConsultationController::class, 'hikerIndex'])->name('pendaki.consultasi.index');
        Route::post('/pendaki/consultasi', [ConsultationController::class, 'store'])->name('pendaki.consultasi.store');

        Route::get('pendaki/screenings', [ScreeningController::class, 'index'])->name('screenings.index');
        Route::get('pendaki/screenings/create', [ScreeningController::class, 'create'])->name('screenings.create');
        Route::post('pendaki/screenings', [ScreeningController::class, 'store'])->name('screenings.store');
        Route::get('pendaki/screenings/payment/{id}', [ScreeningController::class, 'payment'])->name('screenings.payment');
        Route::post('pendaki/screenings/payment-callback', [ScreeningController::class, 'paymentCallback'])->name('screenings.payment.callback');


        // Rute untuk menampilkan jadwal yang belum memiliki konsultasi
        Route::get('pendaki/consultasi-schedule', [ConsultationController::class, 'createSchedule'])->name('pendaki.create_schedule');

        Route::get('pendaki/appointments', [AppointmentController::class, 'index'])->name('pendaki.appointments.index');
        Route::get('pendaki/appointments/create', [AppointmentController::class, 'create'])->name('pendaki.appointments.create');
        Route::post('pendaki/appointments', [AppointmentController::class, 'store'])->name('pendaki.appointments.store');
        Route::get('pendaki/appointments/{appointment}', [AppointmentController::class, 'show'])->name('pendaki.appointments.show');
        Route::get('pendaki/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('pendaki.appointments.edit');
        Route::put('pendaki/appointments/{appointment}', [AppointmentController::class, 'update'])->name('pendaki.appointments.update');
        Route::delete('pendaki/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('pendaki.appointments.destroy');

    });

    //  Role Dokter
    Route::middleware(['role:dokter'])->group(function () {
        Route::get('/dokter/dashboard', [DokterController::class, 'index'])->name('dokter.welcome');
        Route::get('/dokter/consultasi', [ConsultationController::class, 'doctorIndex'])->name('dokter.consultasi.index');
        Route::post('/dokter/consultasi/{consultation}/complete', [ConsultationController::class, 'complete'])->name('dokter.consultasi.complete');
        // Rute untuk menampilkan jadwal konsultasi dokter
        Route::get('dokter/jadwal', [ConsultationController::class, 'doctorSchedule'])->name('dokter.schedule');
        // Rute untuk menyelesaikan konsultasi
        Route::patch('dokter/consultations/{consultation}/complete', [ConsultationController::class, 'ScheduleComplete'])->name('dokter.complete');
        Route::get('dokter/appointments', [AppointmentController::class, 'doctorIndex'])->name('dokter.appointments.index');
        Route::get('dokter/appointments/{appointment}', [AppointmentController::class, 'doctorShow'])->name('dokter.appointments.show');
        Route::put('dokter/appointments/{appointment}/confirm', [AppointmentController::class, 'accept'])->name('dokter.appointments.confirm');
        Route::put('dokter/appointments/{appointment}/complete', [AppointmentController::class, 'complete'])->name('dokter.appointments.complete');
        // Rute untuk rekam medis
        Route::get('dokter/appointments/{appointment}/edit', [MedicalRecordController::class, 'edit'])->name('dokter.medical_records.edit');
        Route::put('dokter/appointments/{appointment}/update', [MedicalRecordController::class, 'update'])->name('dokter.medical_records.update');


    });
    // Role Paramedis
    Route::middleware(['role:paramedis'])->group(function () {
        Route::get('/paramedis/dashboard', [ParamedisController::class, 'index'])->name('paramedis.welcome');
        Route::get('/paramedis/screening', [ParamedisController::class, 'dashboard'])->name('paramedis.dashboard');
        Route::get('/paramedis/data', [ParamedisController::class, 'dashboard'])->name('paramedis.data');
        Route::post('/paramedis/health-check/{id}', [ParamedisController::class, 'processHealthCheck'])->name('paramedis.processHealthCheck');

        // screening Offline
        Route::get('/paramedis/screening-offline', [ParamedisController::class, 'ScreeningOffline'])->name('paramedis.ScreeningOffline');
        Route::post('/paramedis/confirm/{id}', [ParamedisController::class, 'updateHealthCheck'])->name('paramedis.confirm');
    });


    // Role Koordinator
    Route::middleware(['role:koordinator'])->group(function () {
        Route::get('/koordinator/dashboard', [KoordinatorPenyelamatController::class, 'index'])->name('koordinator.welcome');

    });

    // Role Manajer
    Route::middleware(['auth', 'role:manajer'])->group(function () {
        Route::get('/manajer/dashboard', [ManajerController::class, 'index'])->name('manajer.welcome');
        Route::get('/manajer/schedule', [ManajerController::class, 'showScheduleForm'])->name('manajer.schedule.form');
        Route::post('/manajer/schedule', [ManajerController::class, 'storeSchedule'])->name('manajer.schedule.store');

        // Menghasilkan laporan
        Route::get('/manajer/reports', [ManajerController::class, 'viewReports'])->name('manajer.reports');
        Route::post('/manajer/report', [ManajerController::class, 'generateReport'])->name('manajer.report.generate');
    });

    // Role Kasir
    Route::middleware(['role:kasir'])->group(function () {

        Route::get('/kasir/dashboard', [KasirController::class, 'index'])->name('kasir.welcome');

        Route::post('/kasir/confirm-payment/{id}', [KasirController::class, 'confirmPayment'])->name('kasir.confirmPayment');

        Route::get('/kasir/certificate/{id}', [KasirController::class, 'showCertificate'])->name('kasir.showCertificate');

        Route::get('/kasir/certificates', [KasirController::class, 'viewCertificates'])->name('kasir.certificates');

        // Screening Offline
        Route::get('/kasir/sc', [KasirController::class, 'ScreeningOffline'])->name('kasir.index');
        Route::post('/kasir/confirm/{id}', [KasirController::class, 'confirmPayment'])->name('kasir.confirm');
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

        Route::get('queues', [QueueController::class, 'index'])->name('queues.index');
        Route::get('queues/confirm-payment/{id}', [QueueController::class, 'confirmPayment'])->name('queues.confirmPayment');

        Route::get('{queue}', [ScreeningOfflineController::class, 'create'])->name('screenings.offline.create');
        Route::post('screenings/offline/{queue}', [ScreeningOfflineController::class, 'store'])->name('screenings.offline.store');

        Route::get('payments/create/{queue}', [PaymentController::class, 'create'])->name('payments.create');
        Route::post('payments/store/{queue}', [PaymentController::class, 'store'])->name('payments.store');
    });
});

// Screening Offline
Route::get('/screening-offline/create', [ScreeningOfflineController::class, 'create'])->name('screening-offline.create');
Route::post('/screening-offline', [ScreeningOfflineController::class, 'store'])->name('screening-offline.store');
