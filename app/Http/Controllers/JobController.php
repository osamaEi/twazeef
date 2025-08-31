<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('role:company')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Job::with('company')->active()->notExpired();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($companyQuery) use ($search) {
                        $companyQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by job type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by experience level
        if ($request->filled('experience')) {
            $query->where('experience_level', $request->experience);
        }

        $jobs = $query->latest()->paginate(12)->withQueryString();

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,contract,freelance',
            'experience_level' => 'required|in:entry,mid,senior,executive',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'salary_currency' => 'required|string|size:3',
            'skills' => 'nullable|array',
            'skills.*' => 'string',
            'benefits' => 'nullable|array',
            'benefits.*' => 'string',
            'status' => 'nullable|in:active,paused,closed,draft',
            'expires_at' => 'nullable|date|after:today',
        ]);

        $job = new Job($request->all());
        $job->company_id = Auth::id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('jobs', $imageName, 'public');
            $job->image = $imagePath;
        }

        // Set default status if not provided
        if (!$job->status) {
            $job->status = 'active';
        }

        $job->save();

        return redirect()->route('jobs.show', $job)->with('success', 'Job posted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $job->load('company', 'applications');

        // Check if current user has already applied
        $hasApplied = false;
        $userApplication = null;

        if (auth()->check()) {
            $hasApplied = $job->hasUserApplied(auth()->id());
            if ($hasApplied) {
                $userApplication = $job->getUserApplication(auth()->id());
            }
        }

        return view('jobs.show', compact('job', 'hasApplied', 'userApplication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        if ($job->company_id !== Auth::id()) {
            abort(403);
        }
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        if ($job->company_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'location' => 'required|string|max:255',
            'type' => 'required|in:full-time,part-time,contract,freelance',
            'experience_level' => 'required|in:entry,mid,senior,executive',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'salary_currency' => 'required|string|size:3',
            'skills' => 'nullable|array',
            'skills.*' => 'string',
            'benefits' => 'nullable|array',
            'benefits.*' => 'string',
            'status' => 'required|in:active,paused,closed,draft',
            'expires_at' => 'nullable|date|after:today',
        ]);

        // Prepare data for update
        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($job->image) {
                Storage::disk('public')->delete($job->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('jobs', $imageName, 'public');
            $data['image'] = $imagePath;
        }

        // Handle empty arrays for skills and benefits
        if (empty($data['skills'])) {
            $data['skills'] = [];
        }

        if (empty($data['benefits'])) {
            $data['benefits'] = [];
        }

        // Handle expires_at field
        if (empty($data['expires_at'])) {
            $data['expires_at'] = null;
        }

        try {
            $job->update($data);

            return redirect()->route('jobs.show', $job)
                ->with('success', 'تم تحديث الوظيفة بنجاح!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'حدث خطأ أثناء تحديث الوظيفة. يرجى المحاولة مرة أخرى.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        if ($job->company_id !== Auth::id()) {
            abort(403);
        }

        // Delete image if exists
        if ($job->image) {
            Storage::disk('public')->delete($job->image);
        }

        $job->delete();

        return redirect()->route('dashboard')->with('success', 'Job deleted successfully!');
    }

    /**
     * Display company's active jobs
     */
    public function companyActive()
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
    public function companyPaused()
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
    public function companyClosed()
    {
        $jobs = Job::where('company_id', Auth::id())
            ->where('status', 'closed')
            ->withCount('applications')
            ->latest()
            ->paginate(15);

        return view('company.jobs.closed', compact('jobs'));
    }
}
