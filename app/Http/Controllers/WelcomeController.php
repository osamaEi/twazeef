<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Get the top 3 highest-paying jobs
        $topJobs = Job::where('status', 'active')
            ->whereNotNull('salary_max')
            ->orderBy('salary_max', 'desc')
            ->limit(3)
            ->get();

        return view('welcome', compact('topJobs'));
    }
}
