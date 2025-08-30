<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of all companies
     */
    public function index()
    {
        $companies = User::where('role', 'company')
            ->with(['jobs']) // Eager load jobs relationship
            ->paginate(20);

        // Get approved companies (email verified)
        $approvedCompanies = User::where('role', 'company')
            ->where('email_verified_at', '!=', null)
            ->get();

        // Get companies under review (email not verified)
        $underReviewCompanies = User::where('role', 'company')
            ->where('email_verified_at', null)
            ->get();

        return view('admin.companies.index', compact('companies', 'approvedCompanies', 'underReviewCompanies'));
    }

    /**
     * Show the form for creating a new company
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created company
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'company_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'employee_count' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'in:active,pending,inactive'],
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('company-logos', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password123'), // Default password
            'role' => 'company',
            'company_name' => $request->company_name,
            'description' => $request->description,
            'phone' => $request->phone,
            'address' => $request->address,
            'logo' => $logoPath,
            'employee_count' => $request->employee_count,
            'status' => $request->status ?? 'pending',
        ]);

        return redirect()->route('admin.companies.index')->with('success', 'تم إنشاء الشركة بنجاح');
    }

    /**
     * Display the specified company
     */
    public function show(User $company)
    {
        if ($company->role !== 'company') {
            abort(404);
        }
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified company
     */
    public function edit(User $company)
    {
        if ($company->role !== 'company') {
            abort(404);
        }
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified company
     */
    public function update(Request $request, User $company)
    {
        if ($company->role !== 'company') {
            abort(404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $company->id],
            'company_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'employee_count' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'in:active,pending,inactive'],
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'description' => $request->description,
            'phone' => $request->phone,
            'address' => $request->address,
            'employee_count' => $request->employee_count,
            'status' => $request->status,
        ];

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }
            $updateData['logo'] = $request->file('logo')->store('company-logos', 'public');
        }

        $company->update($updateData);

        return redirect()->route('admin.companies.index')->with('success', 'تم تحديث الشركة بنجاح');
    }

    /**
     * Remove the specified company
     */
    public function destroy(User $company)
    {
        if ($company->role !== 'company') {
            abort(404);
        }

        $company->delete();
        return redirect()->route('admin.companies.index')->with('success', 'تم حذف الشركة بنجاح');
    }

    /**
     * Show approved companies
     */
    public function approved()
    {
        $companies = User::where('role', 'company')
            ->where('email_verified_at', '!=', null)
            ->paginate(20);
        return view('admin.companies.approved', compact('companies'));
    }

    /**
     * Show companies under review
     */
    public function underReview()
    {
        $companies = User::where('role', 'company')
            ->where('email_verified_at', null)
            ->paginate(20);
        return view('admin.companies.under-review', compact('companies'));
    }

    /**
     * Approve a company
     */
    public function approve(User $company)
    {
        if ($company->role !== 'company') {
            abort(404);
        }

        $company->update(['email_verified_at' => now()]);
        return redirect()->back()->with('success', 'تم اعتماد الشركة بنجاح');
    }
}
