<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of all applications
     */
    public function index()
    {
        $applications = Application::paginate(20);
        return view('admin.applicants.index', compact('applications'));
    }

    /**
     * Display the specified application
     */
    public function show(Application $application)
    {
        return view('admin.applicants.show', compact('application'));
    }

    /**
     * Show the form for editing the specified application
     */
    public function edit(Application $application)
    {
        return view('admin.applicants.edit', compact('application'));
    }

    /**
     * Update the specified application
     */
    public function update(Request $request, Application $application)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:pending,approved,rejected,under_review'],
            'notes' => ['nullable', 'string'],
        ]);

        $application->update($request->all());

        return redirect()->route('admin.applicants.index')->with('success', 'تم تحديث الطلب بنجاح');
    }

    /**
     * Remove the specified application
     */
    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->route('admin.applicants.index')->with('success', 'تم حذف الطلب بنجاح');
    }

    /**
     * Show applications under review
     */
    public function underReview()
    {
        $applications = Application::where('status', 'under_review')
            ->with(['user', 'job'])
            ->paginate(20);
        return view('admin.applicants.under-review', compact('applications'));
    }

    /**
     * Show approved applications
     */
    public function approved()
    {
        $applications = Application::where('status', 'approved')
            ->with(['user', 'job'])
            ->paginate(20);
        return view('admin.applicants.approved', compact('applications'));
    }

    /**
     * Show rejected applications
     */
    public function rejected()
    {
        $applications = Application::where('status', 'rejected')
            ->with(['user', 'job'])
            ->paginate(20);
        return view('admin.applicants.rejected', compact('applications'));
    }

    /**
     * Show candidate database
     */
    public function candidates()
    {
        $candidates = User::where('role', 'employee')
            ->with(['applications'])
            ->paginate(20);
        return view('admin.applicants.candidates', compact('candidates'));
    }

    /**
     * Change application status
     */
    public function changeStatus(Request $request, Application $application)
    {
        $request->validate([
            'status' => ['required', 'string', 'in:pending,approved,rejected,under_review'],
        ]);

        $application->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'تم تغيير حالة الطلب بنجاح');
    }

    /**
     * Bulk update application statuses
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'application_ids' => ['required', 'array'],
            'application_ids.*' => ['exists:applications,id'],
            'status' => ['required', 'string', 'in:pending,approved,rejected,under_review'],
        ]);

        Application::whereIn('id', $request->application_ids)
            ->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'تم تحديث الحالات بنجاح');
    }
}
