<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ApplicationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

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

// Language switching route
Route::get('language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'user.active'])->name('dashboard');

// Company dashboard route
Route::get('/company/dashboard', [CompanyController::class, 'dashboard'])->middleware(['auth', 'verified', 'role:company', 'user.active'])->name('company.dashboard');

// Employee dashboard route
Route::get('/employee/dashboard', [DashboardController::class, 'employeeDashboard'])->middleware(['auth', 'verified', 'role:employee', 'user.active'])->name('employee.dashboard');

Route::middleware(['auth', 'user.active'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Jobs routes
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');

    // Company routes
    Route::middleware('role:company')->group(function () {
        Route::get('/company/jobs/create', [JobController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
        Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

        // Company job management
        Route::get('/company/jobs/active', [CompanyController::class, 'activeJobs'])->name('company.jobs.active');
        Route::get('/company/jobs/paused', [CompanyController::class, 'pausedJobs'])->name('company.jobs.paused');
        Route::get('/company/jobs/closed', [CompanyController::class, 'closedJobs'])->name('company.jobs.closed');

        // Company application management
        Route::get('/company/applications', [CompanyController::class, 'applicationsIndex'])->name('company.applications.index');
        Route::get('/company/applications/pending', [CompanyController::class, 'applicationsPending'])->name('company.applications.pending');
        Route::get('/company/applications/shortlisted', [CompanyController::class, 'applicationsShortlisted'])->name('company.applications.shortlisted');
        Route::get('/company/applications/interviewed', [CompanyController::class, 'applicationsInterviewed'])->name('company.applications.interviewed');
        Route::get('/company/applications/accepted', [CompanyController::class, 'applicationsAccepted'])->name('company.applications.accepted');
        Route::get('/company/applications/rejected', [CompanyController::class, 'applicationsRejected'])->name('company.applications.rejected');

        // Job-specific applications
        Route::get('/jobs/{job}/applications', [CompanyController::class, 'jobApplications'])->name('jobs.applications.index');
        Route::get('/jobs/{job}/applications/{application}', [CompanyController::class, 'showApplication'])->name('jobs.applications.show');
        Route::patch('/applications/{application}/status', [CompanyController::class, 'updateApplicationStatus'])->name('applications.status.update');

        // Company candidates
        Route::get('/company/candidates', [CompanyController::class, 'candidatesIndex'])->name('company.candidates.index');
        Route::get('/company/candidates/favorites', [CompanyController::class, 'candidatesFavorites'])->name('company.candidates.favorites');
        Route::get('/company/candidates/search', [CompanyController::class, 'candidatesSearch'])->name('company.candidates.search');

        // Company reports
        Route::get('/company/reports/overview', [CompanyController::class, 'reportsOverview'])->name('company.reports.overview');
        Route::get('/company/reports/jobs', [CompanyController::class, 'reportsJobs'])->name('company.reports.jobs');
        Route::get('/company/reports/applications', [CompanyController::class, 'reportsApplications'])->name('company.reports.applications');
        Route::get('/company/reports/export', [CompanyController::class, 'reportsExport'])->name('company.reports.export');
    });

    // Employee routes
    Route::middleware('role:employee')->group(function () {
        Route::get('/jobs/{job}/apply', [ApplicationController::class, 'create'])->name('applications.create');
        Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
    });

    // Applications routes
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
