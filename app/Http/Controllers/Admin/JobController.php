<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of all jobs
     */
    public function index()
    {
        $jobs = Job::with(['company'])
            ->withCount('applications')
            ->latest()
            ->paginate(20);

        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Display the specified job
     */
    public function show(Job $job)
    {
        return view('admin.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified job
     */
    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    /**
     * Update the specified job
     */
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'salary' => ['nullable', 'string', 'max:100'],
            'location' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:full-time,part-time,contract,freelance'],
            'status' => ['required', 'string', 'in:active,paused,closed'],
        ]);

        $job->update($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'تم تحديث الوظيفة بنجاح');
    }

    /**
     * Remove the specified job
     */
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'تم حذف الوظيفة بنجاح');
    }

    /**
     * Show active jobs
     */
    public function active()
    {
        $jobs = Job::where('status', 'active')->with('user')->paginate(20);
        return view('admin.jobs.active', compact('jobs'));
    }

    /**
     * Show paused jobs
     */
    public function paused()
    {
        $jobs = Job::where('status', 'paused')->with('user')->paginate(20);
        return view('admin.jobs.paused', compact('jobs'));
    }

    /**
     * Show closed jobs
     */
    public function closed()
    {
        $jobs = Job::where('status', 'closed')->with('user')->paginate(20);
        return view('admin.jobs.closed', compact('jobs'));
    }

    /**
     * Change job status
     */
    public function changeStatus(Request $request, Job $job)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:active,paused,closed'],
        ]);

        $job->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'تم تغيير حالة الوظيفة بنجاح');
    }
}
