<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\CompanyInfoRequest;
use App\Http\Requests\ManagerInfoRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\DocumentUploadRequest;
use App\Http\Requests\EmployeePersonalInfoRequest;
use App\Http\Requests\EmployeeProfessionalInfoRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use ZipArchive;

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
    public function uploadDocument(DocumentUploadRequest $request)
    {
        try {
            $user = $request->user();
            $file = $request->file('document_file');
            $documentType = $request->input('document_type');
            $documentName = $request->input('document_name', $file->getClientOriginalName());

            // Delete old file if exists
            $oldField = $this->getDocumentField($documentType);
            if ($user->$oldField) {
                Storage::disk('public')->delete($user->$oldField);
            }

            // Generate unique filename
            $extension = $file->getClientOriginalExtension();
            $filename = $documentType . '_' . $user->id . '_' . time() . '.' . $extension;

            // Store new file
            $path = $file->storeAs('company-documents', $filename, 'public');

            // Update user record
            $user->$oldField = $path;
            $user->save();

            // Log the upload
            Log::info('Document uploaded', [
                'user_id' => $user->id,
                'document_type' => $documentType,
                'file_path' => $path,
                'file_size' => $file->getSize(),
            ]);

            // Check if this is an AJAX request
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم رفع المستند بنجاح',
                    'file_path' => $path,
                    'file_name' => $filename,
                ]);
            }

            return Redirect::back()->with('success', 'تم رفع المستند بنجاح');
        } catch (\Exception $e) {
            Log::error('Document upload error', [
                'user_id' => $request->user()->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء رفع المستند: ' . $e->getMessage(),
                ], 500);
            }

            return Redirect::back()->with('error', 'حدث خطأ أثناء رفع المستند');
        }
    }

    /**
     * Get the document field name based on type.
     */
    private function getDocumentField(string $type): string
    {
        return match ($type) {
            'commercial_license' => 'commercial_license',
            'tax_certificate' => 'tax_certificate',
            'national_id' => 'national_id_image',
            'certificate' => 'certificate_image',
            'cv' => 'cv',
            'additional_documents' => 'additional_documents',
            default => 'commercial_license',
        };
    }

    /**
     * Get company documents configuration.
     */
    public function getCompanyDocumentsConfig(): array
    {
        return [
            'commercial_license' => [
                'name' => 'السجل التجاري',
                'field' => 'commercial_license',
                'icon' => 'fas fa-file-pdf',
                'description' => 'وثيقة السجل التجاري من وزارة التجارة',
                'required' => true,
                'accepted_types' => ['pdf', 'jpg', 'jpeg', 'png'],
                'max_size' => 10240, // 10MB in KB
            ],
            'tax_certificate' => [
                'name' => 'الشهادة الضريبية',
                'field' => 'tax_certificate',
                'icon' => 'fas fa-file-pdf',
                'description' => 'الشهادة الضريبية من هيئة الزكاة والضريبة',
                'required' => true,
                'accepted_types' => ['pdf', 'jpg', 'jpeg', 'png'],
                'max_size' => 10240,
            ],
            'national_id' => [
                'name' => 'صورة الهوية',
                'field' => 'national_id_image',
                'icon' => 'fas fa-id-card',
                'description' => 'صورة الهوية الوطنية للمسؤول',
                'required' => true,
                'accepted_types' => ['jpg', 'jpeg', 'png'],
                'max_size' => 5120, // 5MB in KB
            ],
            'certificate' => [
                'name' => 'الشهادات المهنية',
                'field' => 'certificate_image',
                'icon' => 'fas fa-certificate',
                'description' => 'الشهادات المهنية والدورات التدريبية',
                'required' => false,
                'accepted_types' => ['pdf', 'jpg', 'jpeg', 'png'],
                'max_size' => 10240,
            ],
            'cv' => [
                'name' => 'السيرة الذاتية',
                'field' => 'cv',
                'icon' => 'fas fa-file-alt',
                'description' => 'السيرة الذاتية للمسؤول',
                'required' => false,
                'accepted_types' => ['pdf', 'doc', 'docx'],
                'max_size' => 10240,
            ]
        ];
    }

    /**
     * Get user documents with status.
     */
    public function getUserDocuments(User $user): array
    {
        $config = $this->getCompanyDocumentsConfig();
        $documents = [];

        foreach ($config as $type => $docConfig) {
            $field = $docConfig['field'];
            $hasFile = !empty($user->$field);
            
            $documents[] = [
                'type' => $type,
                'name' => $docConfig['name'],
                'field' => $field,
                'icon' => $docConfig['icon'],
                'description' => $docConfig['description'],
                'required' => $docConfig['required'],
                'accepted_types' => $docConfig['accepted_types'],
                'max_size' => $docConfig['max_size'],
                'has_file' => $hasFile,
                'file_path' => $hasFile ? $user->$field : null,
                'file_url' => $hasFile ? Storage::url($user->$field) : null,
                'file_size' => $hasFile ? $this->getFileSize($user->$field) : null,
                'upload_date' => $hasFile ? $user->updated_at->format('Y-m-d') : null,
            ];
        }

        return $documents;
    }

    /**
     * Get file size in human readable format.
     */
    private function getFileSize(string $filePath): string
    {
        $fullPath = storage_path('app/public/' . $filePath);
        if (!file_exists($fullPath)) {
            return 'غير محدد';
        }

        $bytes = filesize($fullPath);
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Delete a document.
     */
    public function deleteDocument(Request $request)
    {
        try {
            $user = $request->user();
            $documentType = $request->input('document_type');
            
            // Get the field name for this document type
            $field = $this->getDocumentField($documentType);
            
            // Check if the user has this document
            if (!$user->$field) {
                return response()->json([
                    'success' => false,
                    'message' => 'المستند غير موجود',
                ], 404);
            }

            // Delete the file from storage
            $filePath = $user->$field;
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            // Clear the field in database
            $user->$field = null;
            $user->save();

            // Log the deletion
            Log::info('Document deleted', [
                'user_id' => $user->id,
                'document_type' => $documentType,
                'field' => $field,
                'deleted_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'تم حذف المستند بنجاح',
            ]);

        } catch (\Exception $e) {
            Log::error('Document deletion error', [
                'user_id' => $request->user()->id,
                'document_type' => $request->input('document_type'),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف المستند',
                'error' => $e->getMessage(),
            ], 500);
        }
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
