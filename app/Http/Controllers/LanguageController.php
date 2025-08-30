<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch the application locale
     */
    public function switch($locale)
    {
        // Validate the locale
        if (!in_array($locale, ['ar', 'en'])) {
            abort(400, 'Invalid locale');
        }

        // Set the locale in session
        Session::put('locale', $locale);

        // Set the locale for the current request
        App::setLocale($locale);

        // Redirect back to the previous page
        return redirect()->back();
    }
}
