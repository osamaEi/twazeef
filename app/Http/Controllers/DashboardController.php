<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isCompany()) {
            return $this->companyDashboard();
        } else {
            return $this->employeeDashboard();
        }
    }

    private function adminDashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_jobs' => Job::count(),
            'total_applications' => Application::count(),
            'active_jobs' => Job::where('status', 'active')->count(),
            'pending_applications' => Application::where('status', 'pending')->count(),
        ];

        $recent_jobs = Job::with('company')->latest()->take(5)->get();
        $recent_applications = Application::with(['job', 'applicant'])->latest()->take(5)->get();

        return redirect()->route('admin.dashboard');
    }

    private function companyDashboard()
    {
        $user = Auth::user();

        $stats = [
            'total_jobs' => $user->jobs()->count(),
            'active_jobs' => $user->jobs()->where('status', 'active')->count(),
            'total_applications' => Application::whereHas('job', function ($query) use ($user) {
                $query->where('company_id', $user->id);
            })->count(),
            'pending_applications' => Application::whereHas('job', function ($query) use ($user) {
                $query->where('company_id', $user->id);
            })->where('status', 'pending')->count(),
        ];

        $jobs = $user->jobs()->withCount('applications')->latest()->take(10)->get();
        $recent_applications = Application::whereHas('job', function ($query) use ($user) {
            $query->where('company_id', $user->id);
        })->with(['job', 'applicant'])->latest()->take(5)->get();

        return view('dashboard.company', compact('stats', 'jobs', 'recent_applications'));
    }

    private function employeeDashboard()
    {
        $user = Auth::user();

        $stats = [
            'total_applications' => $user->applications()->count(),
            'pending_applications' => $user->applications()->where('status', 'pending')->count(),
            'shortlisted_applications' => $user->applications()->where('status', 'shortlisted')->count(),
            'accepted_applications' => $user->applications()->where('status', 'accepted')->count(),
        ];

        $applications = $user->applications()->with('job')->latest()->take(10)->get();
        $available_jobs = Job::active()->notExpired()->with('company')->latest()->take(10)->get();

        return view('dashboard.employee', compact('stats', 'applications', 'available_jobs'));
    }
}
