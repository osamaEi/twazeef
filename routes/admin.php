<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\PendingRegistrationsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Pending Registrations Management
    Route::prefix('pending-registrations')->name('pending-registrations.')->group(function () {
        Route::get('/', [PendingRegistrationsController::class, 'index'])->name('index');
        Route::get('/employees', [PendingRegistrationsController::class, 'employees'])->name('employees');
        Route::get('/companies', [PendingRegistrationsController::class, 'companies'])->name('companies');
        Route::get('/{user}', [PendingRegistrationsController::class, 'show'])->name('show');
        Route::patch('/{user}/activate', [PendingRegistrationsController::class, 'activate'])->name('activate');
        Route::patch('/{user}/deactivate', [PendingRegistrationsController::class, 'deactivate'])->name('deactivate');
        Route::post('/bulk-activate', [PendingRegistrationsController::class, 'bulkActivate'])->name('bulk-activate');
    });

    // User Management Routes
    Route::resource('users', UserController::class);
    Route::get('users/active', [UserController::class, 'active'])->name('users.active');
    Route::get('users/permissions', [UserController::class, 'permissions'])->name('users.permissions');

    // Company Management Routes
    Route::resource('companies', CompanyController::class);
    Route::get('companies/approved', [CompanyController::class, 'approved'])->name('companies.approved');
    Route::get('companies/under-review', [CompanyController::class, 'underReview'])->name('companies.under-review');
    Route::patch('companies/{company}/approve', [CompanyController::class, 'approve'])->name('companies.approve');

    // Job Management Routes
    Route::resource('jobs', JobController::class)->except(['create', 'store']);
    Route::get('jobs/active', [JobController::class, 'active'])->name('jobs.active');
    Route::get('jobs/paused', [JobController::class, 'paused'])->name('jobs.paused');
    Route::get('jobs/closed', [JobController::class, 'closed'])->name('jobs.closed');
    Route::patch('jobs/{job}/status', [JobController::class, 'changeStatus'])->name('jobs.change-status');

    // Applicant Management Routes
    Route::resource('applicants', ApplicantController::class)->except(['create', 'store']);
    Route::get('applicants/pending', [ApplicantController::class, 'pending'])->name('applicants.pending');
    Route::get('applicants/approved', [ApplicantController::class, 'approved'])->name('applicants.approved');
    Route::get('applicants/rejected', [ApplicantController::class, 'rejected'])->name('applicants.rejected');
    Route::patch('applicants/{applicant}/status', [ApplicantController::class, 'changeStatus'])->name('applicants.change-status');
});
