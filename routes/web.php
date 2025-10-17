<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

require __DIR__.'/auth.php';

//Applicant
Route::middleware(['auth', 'role:applicant'])->group(function () {
    Route::get('/applicant/dashboard', [ApplicantController::class, 'dashboard'])->name('applicant.dashboard');
    Route::get('/applicant/profile/create', [ApplicantController::class, 'create'])->name('applicant.profile.create');
    Route::post('/applicant/profile', [ApplicantController::class, 'store'])->name('applicant.profile.store');
    Route::get('/applicant/profile/edit', [ApplicantController::class, 'edit'])->name('applicant.profile.edit');
    Route::put('/applicant/profile/update', [ApplicantController::class, 'update'])->name('applicant.profile.update');
    Route::get('/applicant/profile/show', [ApplicantController::class, 'show'])->name('applicant.profile.show');
    Route::post('/apply/{jobId}', [ApplicantController::class, 'apply'])->name('applicant.apply');

});

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Job management (admin only)
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
});
     


