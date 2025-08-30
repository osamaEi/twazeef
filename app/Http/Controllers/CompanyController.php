<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:company');
    }

    /**
     * Display company dashboard
     */
    public function dashboard()
    {
        $company = Auth::user();
        $totalJobs = Job::where('company_id', Auth::id())->count();
        $activeJobs = Job::where('company_id', Auth::id())->where('status', 'active')->count();
        $totalApplications = Application::whereHas('job', function ($query) {
            $query->where('company_id', Auth::id());
        })->count();
        $pendingApplications = Application::whereHas('job', function ($query) {
            $query->where('company_id', Auth::id());
        })->where('status', 'pending')->count();

        $recentJobs = Job::where('company_id', Auth::id())
            ->withCount('applications')
            ->latest()
            ->take(5)
            ->get();

        $recentApplications = Application::whereHas('job', function ($query) {
            $query->where('company_id', Auth::id());
        })->with(['job', 'applicant'])
            ->latest()
            ->take(10)
            ->get();

        return view('company.dashboard', compact(
            'company',
            'totalJobs',
            'activeJobs',
            'totalApplications',
            'pendingApplications',
            'recentJobs',
            'recentApplications'
        ));
    }

    // Company Job Management Methods

    /**
     * Display company's active jobs
     */
    public function activeJobs()
    {
        $jobs = Job::where('company_id', Auth::id())
            ->where('status', 'active')
            ->withCount('applications')
            ->latest()
            ->paginate(15);

        return view('company.jobs.active', compact('jobs'));
    }

    /**
     * Display company's paused jobs
     */
    public function pausedJobs()
    {
        $jobs = Job::where('company_id', Auth::id())
            ->where('status', 'paused')
            ->withCount('applications')
            ->latest()
            ->paginate(15);

        return view('company.jobs.paused', compact('jobs'));
    }

    /**
     * Display company's closed jobs
     */
    public function closedJobs()
    {
        $jobs = Job::where('company_id', Auth::id())
            ->where('status', 'closed')
            ->withCount('applications')
            ->latest()
            ->paginate(15);

        return view('company.jobs.closed', compact('jobs'));
    }

    // Company Application Management Methods

    /**
     * Display all applications for company's jobs
     */
    public function applicationsIndex()
    {
        $applications = Application::whereHas('job', function ($query) {
            $query->where('company_id', Auth::id());
        })->with(['job', 'applicant'])->latest()->paginate(20);

        return view('company.applications.index', compact('applications'));
    }

    /**
     * Display pending applications for company's jobs
     */
    public function applicationsPending()
    {
        $applications = Application::whereHas('job', function ($query) {
            $query->where('company_id', Auth::id());
        })->where('status', 'pending')->with(['job', 'applicant'])->latest()->paginate(20);

        return view('company.applications.pending', compact('applications'));
    }

    /**
     * Display shortlisted applications for company's jobs
     */
    public function applicationsShortlisted()
    {
        $applications = Application::whereHas('job', function ($query) {
            $query->where('company_id', Auth::id());
        })->where('status', 'shortlisted')->with(['job', 'applicant'])->latest()->paginate(20);

        return view('company.applications.shortlisted', compact('applications'));
    }

    /**
     * Display interviewed applications for company's jobs
     */
    public function applicationsInterviewed()
    {
        $applications = Application::whereHas('job', function ($query) {
            $query->where('company_id', Auth::id());
        })->where('status', 'interviewed')->with(['job', 'applicant'])->latest()->paginate(20);

        return view('company.applications.interviewed', compact('applications'));
    }

    /**
     * Display accepted applications for company's jobs
     */
    public function applicationsAccepted()
    {
        $applications = Application::whereHas('job', function ($query) {
            $query->where('company_id', Auth::id());
        })->where('status', 'accepted')->with(['job', 'applicant'])->latest()->paginate(20);

        return view('company.applications.accepted', compact('applications'));
    }

    /**
     * Display rejected applications for company's jobs
     */
    public function applicationsRejected()
    {
        $applications = Application::whereHas('job', function ($query) {
            $query->where('company_id', Auth::id());
        })->where('status', 'rejected')->with(['job', 'applicant'])->latest()->paginate(20);

        return view('company.applications.rejected', compact('applications'));
    }

    // Company Candidates Methods

    /**
     * Display all candidates who applied to company's jobs
     */
    public function candidatesIndex()
    {
        $candidates = User::where('role', 'employee')
            ->whereHas('applications.job', function ($query) {
                $query->where('company_id', Auth::id());
            })->with(['applications' => function ($query) {
                $query->whereHas('job', function ($q) {
                    $q->where('company_id', Auth::id());
                });
            }])->paginate(20);

        return view('company.candidates.index', compact('candidates'));
    }

    /**
     * Display company's favorite candidates
     */
    public function candidatesFavorites()
    {
        // This would need a favorites table implementation
        $candidates = collect(); // Placeholder for now
        return view('company.candidates.favorites', compact('candidates'));
    }

    /**
     * Search candidates for company
     */
    public function candidatesSearch(Request $request)
    {
        $query = User::where('role', 'employee');

        if ($request->filled('skills')) {
            $skills = explode(',', $request->skills);
            $query->whereJsonContains('skills', $skills);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $candidates = $query->paginate(20);

        return view('company.candidates.search', compact('candidates'));
    }

    // Company Reports Methods

    /**
     * Display company reports overview
     */
    public function reportsOverview()
    {
        $stats = [
            'total_jobs' => Auth::user()->jobs()->count(),
            'active_jobs' => Auth::user()->jobs()->where('status', 'active')->count(),
            'total_applications' => Application::whereHas('job', function ($query) {
                $query->where('company_id', Auth::id());
            })->count(),
            'pending_applications' => Application::whereHas('job', function ($query) {
                $query->where('company_id', Auth::id());
            })->where('status', 'pending')->count(),
        ];

        return view('company.reports.overview', compact('stats'));
    }

    /**
     * Display company jobs report
     */
    public function reportsJobs()
    {
        $jobs = Auth::user()->jobs()->withCount('applications')->latest()->get();
        return view('company.reports.jobs', compact('jobs'));
    }

    /**
     * Display company applications report
     */
    public function reportsApplications()
    {
        $applications = Application::whereHas('job', function ($query) {
            $query->where('company_id', Auth::id());
        })->with(['job', 'applicant'])->latest()->get();

        return view('company.reports.applications', compact('applications'));
    }

    /**
     * Export company reports
     */
    public function reportsExport()
    {
        // This would implement CSV/Excel export functionality
        return view('company.reports.export');
    }

    /**
     * Display applications for a specific job
     */
    public function jobApplications(Job $job)
    {
        // Check if the authenticated user owns this job
        if ($job->company_id !== Auth::id()) {
            abort(403, 'Unauthorized access to job applications.');
        }

        $applications = $job->applications()->with('applicant')->latest()->paginate(20);

        return view('company.applications.job_applications', compact('job', 'applications'));
    }

    /**
     * Display a specific application for a job
     */
    public function showApplication(Job $job, Application $application)
    {
        // Check if the authenticated user owns this job
        if ($job->company_id !== Auth::id()) {
            abort(403, 'Unauthorized access to job applications.');
        }

        // Check if the application belongs to this job
        if ($application->job_id !== $job->id) {
            abort(404, 'Application not found for this job.');
        }

        $application->load(['applicant', 'job']);

        return view('company.applications.show_application', compact('job', 'application'));
    }

    /**
     * Update application status via AJAX
     */
    public function updateApplicationStatus(Request $request, Application $application)
    {
        // Check if the authenticated user owns the job for this application
        if ($application->job->company_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized access'], 403);
        }

        $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,interviewed,accepted,rejected'
        ]);

        $oldStatus = $application->status;
        $application->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث حالة التقديم بنجاح',
            'new_status' => $request->status,
            'old_status' => $oldStatus,
            'status_text' => $this->getStatusText($request->status),
            'updated_at' => $application->updated_at->format('Y/m/d H:i')
        ]);
    }

    /**
     * Get Arabic text for status
     */
    private function getStatusText($status)
    {
        return match ($status) {
            'pending' => 'في الانتظار',
            'reviewed' => 'تمت المراجعة',
            'shortlisted' => 'قائمة مختصرة',
            'interviewed' => 'تمت المقابلة',
            'accepted' => 'مقبول',
            'rejected' => 'مرفوض',
            default => $status
        };
    }
}
