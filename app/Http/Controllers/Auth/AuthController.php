<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display the employee registration view.
     */
    public function showEmployeeRegister(): View
    {
        return view('auth.employee-register');
    }

    /**
     * Display the company registration view.
     */
    public function showCompanyRegister(): View
    {
        return view('auth.company-register');
    }

    /**
     * Display the login view.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Handle employee registration.
     */
    public function registerEmployee(Request $request)
    {
        // Debug: Log the request data
        Log::info('Employee registration attempt', [
            'method' => $request->method(),
            'url' => $request->url(),
            'all_data' => $request->all(),
            'files' => $request->allFiles()
        ]);

        try {
            $request->validate([
                'first_name_ar' => ['required', 'string', 'max:255'],
                'last_name_ar' => ['required', 'string', 'max:255'],
                'first_name_en' => ['required', 'string', 'max:255'],
                'last_name_en' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'phone' => ['required', 'string', 'regex:/^\+966\s?5[0-9]{8}$/'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'national_id' => ['required', 'string', 'regex:/^[0-9]{10}$/'],
                'birth_date' => ['required', 'date', 'before:' . now()->subYears(16)->format('Y-m-d')],
                'gender' => ['required', 'in:male,female'],
                'marital_status' => ['required', 'in:single,married,divorced,widowed'],
                'education' => ['required', 'in:high-school,diploma,bachelor,master,phd'],
                'specialization' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:500'],
                'bio' => ['nullable', 'string', 'max:1000'],
                'national_id_image' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
                'certificate_image' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
                'experience_certificate' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
                'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Debug: Log validation errors
            Log::error('Employee registration validation failed', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'خطأ في التحقق من البيانات',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }

        try {
            // Debug: Log validation passed
            Log::info('Employee registration validation passed');

            // Handle file uploads
            $nationalIdImage = null;
            $certificateImage = null;
            $experienceCertificate = null;
            $cv = null;

            if ($request->hasFile('national_id_image')) {
                $nationalIdImage = $request->file('national_id_image')->store('documents/national_id', 'public');
                Log::info('National ID image stored', ['path' => $nationalIdImage]);
            }
            if ($request->hasFile('certificate_image')) {
                $certificateImage = $request->file('certificate_image')->store('documents/certificates', 'public');
                Log::info('Certificate image stored', ['path' => $certificateImage]);
            }
            if ($request->hasFile('experience_certificate')) {
                $experienceCertificate = $request->file('experience_certificate')->store('documents/experience', 'public');
                Log::info('Experience certificate stored', ['path' => $experienceCertificate]);
            }
            if ($request->hasFile('cv')) {
                $cv = $request->file('cv')->store('documents/cv', 'public');
                Log::info('CV stored', ['path' => $cv]);
            }

            // Debug: Log the data being inserted
            $userData = [
                'first_name_ar' => $request->first_name_ar,
                'last_name_ar' => $request->last_name_ar,
                'first_name_en' => $request->first_name_en,
                'last_name_en' => $request->last_name_en,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'employee',
                'phone' => $request->phone,
                'national_id' => $request->national_id,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'marital_status' => $request->marital_status,
                'education' => $request->education,
                'specialization' => $request->specialization,
                'address' => $request->address,
                'bio' => $request->bio,
                'national_id_image' => $nationalIdImage,
                'certificate_image' => $certificateImage,
                'experience_certificate' => $experienceCertificate,
                'cv' => $cv,
                'status' => 'pending',
                'is_active' => false,
            ];

            Log::info('Attempting to create user with data', $userData);

            $user = User::create($userData);

            Log::info('User created successfully', ['user_id' => $user->id]);

            //event(new Registered($user));

            // Send email verification
            //      $user->sendEmailVerificationNotification();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم إنشاء الحساب بنجاح. يرجى التحقق من بريدك الإلكتروني.',
                    'user_id' => $user->id
                ]);
            }

            // Return to the same registration view with success message
            return back()->with('success', 'تم استلام طلب التسجيل بنجاح! 🎉 سيتم مراجعة بياناتك والمستندات المرفقة خلال 24-48 ساعة. ستصلك رسالة تأكيد عبر البريد الإلكتروني. يمكنك متابعة حالة طلبك من خلال نفس الصفحة.');
        } catch (\Exception $e) {
            // Debug: Log the error details
            Log::error('Employee registration failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء إنشاء الحساب: ' . $e->getMessage()
                ], 500);
            }

            return back()->withErrors(['error' => 'حدث خطأ أثناء إنشاء الحساب. يرجى المحاولة مرة أخرى.']);
        }
    }

    /**
     * Handle company registration.
     */
    public function registerCompany(Request $request): Response|RedirectResponse|JsonResponse
    {
        // Debug: Log the request at the very beginning
        Log::info('Company registration method called', [
            'method' => $request->method(),
            'url' => $request->url(),
            'all_data' => $request->all(),
            'entity_type' => $request->input('entityType'),
            'has_entity_type' => $request->has('entityType')
        ]);

        try {
            $request->validate([
                // Entity/Company Information
                'entityType' => ['required', 'string', 'in:private-company,limited-company,joint-stock-company,individual-establishment'],
                'entityNameAr' => ['required', 'string', 'max:255'],
                'entityNameEn' => ['required', 'string', 'max:255'],
                'licenseNumber' => ['required', 'string', 'max:255'],
                'establishmentDate' => ['required', 'date', 'before:today'],
                'businessSector' => ['required', 'string', 'in:energy,construction,manufacturing,agriculture,transportation,telecommunications,healthcare,education,tourism,finance,real-estate,mining,water,environment,other'],
                'employeeCount' => ['required', 'string', 'in:1-50,51-200,201-500,501-1000,1000+'],
                'entityAddress' => ['required', 'string', 'max:1000'],
                'entityPhone' => ['required', 'string', 'regex:/^\+966\s?[0-9]{8,9}$/'],
                'entityEmail' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
                'entityDescription' => ['nullable', 'string', 'max:2000'],

                // Responsible Person Information
                'responsibleName' => ['required', 'string', 'max:255'],
                'responsiblePosition' => ['required', 'string', 'max:255'],
                'responsibleID' => ['required', 'string', 'max:255'],
                'responsiblePhone' => ['required', 'string', 'regex:/^\+966\s?[0-9]{8,9}$/'],
                'responsibleEmail' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                'responsibleDepartment' => ['required', 'string', 'max:255'],
                'authorizationScope' => ['required', 'string', 'max:1000'],

                // Required Documents
                'licenseFile' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'], // 10MB
                'authorizationFile' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'], // 10MB
                'idFile' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:5120'], // 5MB

                // Account Information
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required', 'string', 'min:8'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'خطأ في التحقق من البيانات',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }

        try {
            // Debug: Log the request data
            Log::info('Company registration attempt', [
                'all_data' => $request->all(),
                'has_files' => [
                    'licenseFile' => $request->hasFile('licenseFile'),
                    'authorizationFile' => $request->hasFile('authorizationFile'),
                    'idFile' => $request->hasFile('idFile')
                ],
                'entity_type' => $request->input('entityType'),
                'request_data' => $request->except(['password', 'password_confirmation'])
            ]);

            // Handle file uploads
            if (!$request->hasFile('licenseFile') || !$request->hasFile('authorizationFile') || !$request->hasFile('idFile')) {
                throw new \Exception('جميع الملفات المطلوبة يجب أن تكون مرفقة');
            }

            $licensePath = $request->file('licenseFile')->store('documents/company/licenses', 'public');
            $authorizationPath = $request->file('authorizationFile')->store('documents/company/authorizations', 'public');
            $idPath = $request->file('idFile')->store('documents/company/ids', 'public');

            // Handle additional files if any
            $additionalFiles = [];
            if ($request->hasFile('additionalFiles')) {
                foreach ($request->file('additionalFiles') as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('documents/company/additional', 'public');
                        $additionalFiles[] = $path;
                    }
                }
            }

            // Debug: Log the data being inserted
            $userData = [
                'name' => $request->entityNameAr, // Use Arabic name as primary name
                'first_name_ar' => $request->entityNameAr,
                'first_name_en' => $request->entityNameEn,
                'email' => $request->entityEmail,
                'password' => Hash::make($request->password),
                'role' => 'company',
                'phone' => $request->entityPhone,
                'is_active' => false,

                // Company specific fields
                'company_name' => $request->entityNameAr,
                'website' => null, // Not in current form
                'description' => $request->entityDescription,
                'employee_count' => $request->employeeCount,
                'address' => $request->entityAddress,
                'logo' => null, // Not in current form

                // New fields from the form
                'entity_type' => $request->entityType,
                'license_number' => $request->licenseNumber,
                'establishment_date' => $request->establishmentDate,
                'business_sector' => $request->businessSector,
                'entity_phone' => $request->entityPhone,
                'entity_email' => $request->entityEmail,
                'entity_description' => $request->entityDescription,

                // Responsible person fields
                'responsible_name' => $request->responsibleName,
                'responsible_position' => $request->responsiblePosition,
                'responsible_id' => $request->responsibleID,
                'responsible_phone' => $request->responsiblePhone,
                'responsible_email' => $request->responsibleEmail,
                'responsible_department' => $request->responsibleDepartment,
                'authorization_scope' => $request->authorizationScope,

                // Document paths
                'commercial_license' => $licensePath,
                'tax_certificate' => $authorizationPath, // Using authorization as tax certificate for now
                'additional_documents' => !empty($additionalFiles) ? json_encode($additionalFiles) : null,
                'id_image' => $idPath,

                'status' => 'pending',
            ];

            Log::info('Attempting to create company user with data', [
                'user_data' => array_merge($userData, ['password' => '[HIDDEN]'])
            ]);

            // Create the company user
            User::create($userData);

            // event(new Registered($user));

            // Send email verification
            //  $user->sendEmailVerificationNotification();

            // Always redirect on success for traditional form submission
            return redirect()->route('verification.notice')->with('status', 'تم إنشاء حساب الشركة بنجاح. يرجى التحقق من بريدك الإلكتروني.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Company registration error: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->except(['password', 'password_confirmation'])
            ]);

            // Always redirect back with errors for traditional form submission
            return back()->withErrors(['error' => 'حدث خطأ أثناء إنشاء الحساب: ' . $e->getMessage()]);
        }
    }

    /**
     * Handle login for both user types.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Check if user is active
            if (!$user->isActive()) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'حسابك غير مفعل. يرجى التواصل مع الإدارة لتفعيل حسابك.',
                ])->onlyInput('email');
            }

            // Check if user is approved (for companies)
            if ($user->role === 'company' && $user->status === 'pending') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'حسابك قيد المراجعة. سيتم إشعارك عند الموافقة.',
                ])->onlyInput('email');
            }

            // Redirect based on role
            if ($user->role === 'company') {
                return redirect()->intended(route('company.dashboard'));
            } elseif ($user->role === 'employee') {
                return redirect()->intended(route('employee.dashboard'));
            } elseif ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }

        return back()->withErrors([
            'email' => 'بيانات الاعتماد المقدمة غير صحيحة.',
        ])->onlyInput('email');
    }

    /**
     * Logout user.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
