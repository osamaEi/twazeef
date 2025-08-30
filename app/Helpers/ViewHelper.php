<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class ViewHelper
{
    /**
     * Get current user with caching
     */
    public static function getCurrentUser()
    {
        static $user = null;

        if ($user === null) {
            $user = Auth::user();
        }

        return $user;
    }

    /**
     * Get current locale with caching
     */
    public static function getCurrentLocale()
    {
        static $locale = null;

        if ($locale === null) {
            $locale = App::getLocale();
        }

        return $locale;
    }

    /**
     * Check if user has specific role
     */
    public static function hasRole($role)
    {
        $user = self::getCurrentUser();
        return $user && $user->role === $role;
    }

    /**
     * Get user role with caching
     */
    public static function getUserRole()
    {
        $user = self::getCurrentUser();
        return $user ? $user->role : null;
    }

    /**
     * Check if current locale is RTL
     */
    public static function isRTL()
    {
        return self::getCurrentLocale() === 'ar';
    }

    /**
     * Get RTL/LTR class based on locale
     */
    public static function getDirectionClass()
    {
        return self::isRTL() ? 'rtl' : 'ltr';
    }

    /**
     * Get sidebar class based on locale
     */
    public static function getSidebarClass()
    {
        return 'sidebar-' . self::getDirectionClass();
    }

    /**
     * Format date based on locale
     */
    public static function formatDate($date, $format = null)
    {
        if (!$date) return '';

        if ($format === null) {
            $format = self::isRTL() ? 'Y/m/d' : 'm/d/Y';
        }

        return $date->format($format);
    }

    /**
     * Get status badge class
     */
    public static function getStatusBadgeClass($status)
    {
        $statusClasses = [
            'active' => 'active',
            'pending' => 'pending',
            'approved' => 'active',
            'rejected' => 'pending',
            'under-review' => 'review',
            'paused' => 'warning',
            'closed' => 'inactive'
        ];

        return $statusClasses[$status] ?? 'default';
    }

    /**
     * Get count with fallback
     */
    public static function getCount($collection, $fallback = 0)
    {
        if (!$collection) return $fallback;

        if (method_exists($collection, 'total')) {
            return $collection->total();
        }

        if (method_exists($collection, 'count')) {
            return $collection->count();
        }

        return $fallback;
    }
}
