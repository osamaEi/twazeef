<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PendingRegistrationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    /**
     * Display pending registrations dashboard
     */
    public function index()
    {
        // Get pending employees (not active)
        $pendingEmployees = User::where('role', 'employee')
            ->where('is_active', false)
            ->latest()
            ->paginate(15);

        // Get pending companies (not active)
        $pendingCompanies = User::where('role', 'company')
            ->where('is_active', false)
            ->latest()
            ->paginate(15);

        // Calculate stats
        $stats = [
            'total_pending' => User::where('is_active', false)->count(),
            'pending_employees' => User::where('role', 'employee')->where('is_active', false)->count(),
            'pending_companies' => User::where('role', 'company')->where('is_active', false)->count(),
            'recent_registrations' => User::where('is_active', false)
                ->where('created_at', '>=', now()->subDays(7))
                ->count(),
        ];

        return view('admin.pending-registrations.index', compact(
            'pendingEmployees',
            'pendingCompanies',
            'stats'
        ));
    }

    /**
     * Display pending employees
     */
    public function employees()
    {
        $pendingEmployees = User::where('role', 'employee')
            ->where('is_active', false)
            ->latest()
            ->paginate(20);

        return view('admin.pending-registrations.employees', compact('pendingEmployees'));
    }

    /**
     * Display pending companies
     */
    public function companies()
    {
        $pendingCompanies = User::where('role', 'company')
            ->where('is_active', false)
            ->latest()
            ->paginate(20);

        return view('admin.pending-registrations.companies', compact('pendingCompanies'));
    }

    /**
     * Display user details
     */
    public function show(User $user)
    {
        return view('admin.pending-registrations.show', compact('user'));
    }

    /**
     * Activate a user account
     */
    public function activate(User $user)
    {
        try {
            $user->update(['is_active' => true]);

            Log::info('User account activated', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
                'activated_by' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'تم تفعيل الحساب بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to activate user account', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تفعيل الحساب'
            ], 500);
        }
    }

    /**
     * Deactivate a user account
     */
    public function deactivate(User $user)
    {
        try {
            $user->update(['is_active' => false]);

            Log::info('User account deactivated', [
                'user_id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
                'deactivated_by' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'تم إلغاء تفعيل الحساب بنجاح'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to deactivate user account', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إلغاء تفعيل الحساب'
            ], 500);
        }
    }

    /**
     * Bulk activate users
     */
    public function bulkActivate(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        try {
            $activatedCount = User::whereIn('id', $request->user_ids)
                ->where('is_active', false)
                ->update(['is_active' => true]);

            Log::info('Bulk user activation', [
                'user_ids' => $request->user_ids,
                'activated_count' => $activatedCount,
                'activated_by' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => "تم تفعيل {$activatedCount} حساب بنجاح"
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to bulk activate users', [
                'user_ids' => $request->user_ids,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تفعيل الحسابات'
            ], 500);
        }
    }
}
