<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update company profile information.
     */
    public function updateCompany(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'entity_type' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'establishment_date' => 'nullable|date',
            'business_sector' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:500',
        ]);

        $user->fill($validated);
        $user->save();

        return Redirect::route('company.profile')->with('status', 'profile-updated');
    }

    /**
     * Upload company documents.
     */
    public function uploadDocument(Request $request): RedirectResponse
    {
        $request->validate([
            'document_file' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
            'document_type' => 'required|in:logo,license,certificate',
        ]);

        $user = $request->user();
        $file = $request->file('document_file');
        $documentType = $request->input('document_type');

        // Delete old file if exists
        $oldField = $this->getDocumentField($documentType);
        if ($user->$oldField) {
            Storage::disk('public')->delete($user->$oldField);
        }

        // Store new file
        $path = $file->store('company-documents', 'public');

        // Update user record
        $user->$oldField = $path;
        $user->save();

        return Redirect::back()->with('status', 'document-uploaded');
    }

    /**
     * Get the document field name based on type.
     */
    private function getDocumentField(string $type): string
    {
        return match ($type) {
            'logo' => 'logo',
            'license' => 'license_image',
            'certificate' => 'certificate_image',
            default => 'logo',
        };
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Display the admin profile.
     */
    public function adminProfile(Request $request): View
    {
        $user = $request->user();
        return view('profile.admin', compact('user'));
    }

    /**
     * Display the company profile.
     */
    public function companyProfile(Request $request): View
    {
        $user = $request->user();
        return view('profile.company', compact('user'));
    }

    /**
     * Display the employee profile.
     */
    public function employeeProfile(Request $request): View
    {
        $user = $request->user();
        return view('profile.employee', compact('user'));
    }

    /**
     * Export company data.
     */
    public function exportData(Request $request): RedirectResponse
    {
        // This would typically generate and download a file
        // For now, we'll just redirect with a success message
        return Redirect::back()->with('status', 'export-started');
    }

    /**
     * Share company profile.
     */
    public function shareProfile(Request $request): RedirectResponse
    {
        // This would typically handle sharing functionality
        // For now, we'll just redirect with a success message
        return Redirect::back()->with('status', 'profile-shared');
    }
}
