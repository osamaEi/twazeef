<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:employee')->only(['create', 'store']);
        $this->middleware('role:company')->only(['update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'company') {
            $applications = Application::whereHas('job', function ($query) use ($user) {
                $query->where('company_id', $user->id);
            })->with(['job', 'applicant'])->latest()->paginate(20);
        } else {
            $applications = $user->applications()->with('job')->latest()->paginate(20);
        }

        return view('applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {
        $user = Auth::user();

        // Debug: Log the data being passed
        \Log::info('ApplicationController@create called', [
            'job_id' => $job->id,
            'job_title' => $job->title,
            'user_id' => $user->id,
            'user_role' => $user->role
        ]);

        $hasApplied = Application::where('job_id', $job->id)
            ->where('applicant_id', $user->id)
            ->exists();

        $existingApplication = null;
        if ($hasApplied) {
            $existingApplication = Application::where('job_id', $job->id)
                ->where('applicant_id', $user->id)
                ->first();
        }

        // Load the company relationship to ensure it's available
        $job->load('company');

        return view('applications.create', compact('job', 'hasApplied', 'existingApplication'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'job_id' => 'required|exists:jobs,id',
            'cover_letter' => 'required|string|min:100',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $job = Job::findOrFail($request->job_id);

        // Check if user already applied
        if (Application::where('job_id', $job->id)->where('applicant_id', Auth::id())->exists()) {
            return back()->withErrors(['error' => 'You have already applied for this job.']);
        }

        $application = new Application();
        $application->job_id = $job->id;
        $application->applicant_id = Auth::id();
        $application->cover_letter = $request->cover_letter;
        $application->applied_at = now();

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
            $application->resume_path = $resumePath;
        }

        $application->save();

        return redirect()->route('applications.show', $application)->with('success', 'Application submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        $user = Auth::user();

        if (
            !$user->isAdmin() && $application->applicant_id !== $user->id &&
            $application->job->company_id !== $user->id
        ) {
            abort(403);
        }

        $application->load(['job', 'applicant']);
        return view('applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        if ($application->applicant_id !== Auth::id()) {
            abort(403);
        }

        return view('applications.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        if ($application->applicant_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'cover_letter' => 'required|string|min:100',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $application->cover_letter = $request->cover_letter;

        if ($request->hasFile('resume')) {
            // Delete old resume
            if ($application->resume_path) {
                Storage::disk('public')->delete($application->resume_path);
            }

            $resumePath = $request->file('resume')->store('resumes', 'public');
            $application->resume_path = $resumePath;
        }

        $application->save();

        return redirect()->route('applications.show', $application)->with('success', 'Application updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        if ($application->applicant_id !== Auth::id()) {
            abort(403);
        }

        if ($application->resume_path) {
            Storage::disk('public')->delete($application->resume_path);
        }

        $application->delete();

        return redirect()->route('applications.index')->with('success', 'Application withdrawn successfully!');
    }

    /**
     * Update application status (for companies)
     */
    public function updateStatus(Request $request, Application $application)
    {
        $user = Auth::user();

        if (!$user->isCompany() || $application->job->company_id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,reviewed,shortlisted,interviewed,accepted,rejected',
            'notes' => 'nullable|string',
        ]);

        $application->status = $request->status;
        $application->notes = $request->notes;
        $application->save();

        return back()->with('success', 'Application status updated successfully!');
    }
}
