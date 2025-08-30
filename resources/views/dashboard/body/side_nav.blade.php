    <!-- الشريط الجانبي الأبيض المحسن -->
    <aside class="sidebar {{ app()->getLocale() === 'ar' ? 'sidebar-rtl' : 'sidebar-ltr' }}" style="width : 314px;">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <div class="sidebar-logo-icon">💼</div>
                <div class="sidebar-logo-text">
                    <div class="sidebar-logo-main">{{ __('sidebar.company_name') }}</div>
                    <div class="sidebar-logo-sub">{{ __('sidebar.company_subtitle') }}</div>
                </div>
            </div>
            <div class="entity-badge">
                <i class="fas fa-building"></i>
                <span>{{ __('sidebar.company_full_name') }}</span>
            </div>
        </div>
        
        <nav class="sidebar-nav">
            <!-- Common Dashboard Section for All Roles -->
            
            @if(auth()->user()->role === 'admin')
                <!-- Admin Navigation -->
                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.admin_dashboard') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>{{ __('sidebar.overview') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.user_management') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                <i class="fas fa-users"></i>
                                <span>{{ __('sidebar.all_users') }}</span>
                            </a>
                        </li>
                   
                        
                    </ul>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">إدارة التسجيلات الجديدة</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('admin.pending-registrations.index') }}" class="nav-link {{ request()->routeIs('admin.pending-registrations.*') ? 'active' : '' }}">
                                <i class="fas fa-clock"></i>
                                <span>التسجيلات المعلقة</span>
                            </a>
                        </li>
                     
                    </ul>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.company_management') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('admin.companies.index') }}" class="nav-link {{ request()->routeIs('admin.companies.index') ? 'active' : '' }}">
                                <i class="fas fa-building"></i>
                                <span>{{ __('sidebar.all_companies') }}</span>
                            </a>
                        </li>
                     
                        
                    </ul>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.job_management') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('admin.jobs.index') }}" class="nav-link {{ request()->routeIs('admin.jobs.index') ? 'active' : '' }}">
                                <i class="fas fa-briefcase"></i>
                                <span>{{ __('sidebar.all_jobs') }}</span>
                            </a>
                        </li>
                     
                    </ul>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.applicant_management') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('admin.applicants.index') }}" class="nav-link {{ request()->routeIs('admin.applicants.index') ? 'active' : '' }}">
                                <i class="fas fa-file-alt"></i>
                                <span>{{ __('sidebar.all_applications') }}</span>
                            </a>
                        </li>
                      
                    </ul>
                </div>

              

        

            @elseif(auth()->user()->role === 'company')
                <!-- Company Navigation -->
                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.job_management') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('jobs.create') }}" class="nav-link {{ request()->routeIs('jobs.create') ? 'active' : '' }}">
                                <i class="fas fa-plus-circle"></i>
                                <span>{{ __('sidebar.create_new_job') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('jobs.index') }}" class="nav-link {{ request()->routeIs('jobs.index') ? 'active' : '' }}">
                                <i class="fas fa-list"></i>
                                <span>{{ __('sidebar.all_jobs') }}</span>
                                <span class="nav-badge">{{ auth()->user()->jobs()->count() }}</span>
                            </a>
                        </li>
                    
                    </ul>
                </div>

                {{-- <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.application_management') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('company.applications.index') }}" class="nav-link {{ request()->routeIs('company.applications.index') ? 'active' : '' }}">
                                <i class="fas fa-file-alt"></i>
                                <span>{{ __('sidebar.all_applications') }}</span>
                                <span class="nav-badge">{{ \App\Models\Application::whereHas('job', function($query) { $query->where('company_id', auth()->id()); })->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('company.applications.pending') }}" class="nav-link {{ request()->routeIs('company.applications.pending') ? 'active' : '' }}">
                                <i class="fas fa-clock"></i>
                                <span>{{ __('sidebar.pending_review') }}</span>
                                <span class="nav-badge">{{ \App\Models\Application::whereHas('job', function($query) { $query->where('company_id', auth()->id()); })->where('status', 'pending')->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('company.applications.shortlisted') }}" class="nav-link {{ request()->routeIs('company.applications.shortlisted') ? 'active' : '' }}">
                                <i class="fas fa-star"></i>
                                <span>{{ __('sidebar.shortlisted') }}</span>
                                <span class="nav-badge">{{ \App\Models\Application::whereHas('job', function($query) { $query->where('company_id', auth()->id()); })->where('status', 'shortlisted')->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('company.applications.interviewed') }}" class="nav-link {{ request()->routeIs('company.applications.interviewed') ? 'active' : '' }}">
                                <i class="fas fa-comments"></i>
                                <span>{{ __('sidebar.interviewed') }}</span>
                                <span class="nav-badge">{{ \App\Models\Application::whereHas('job', function($query) { $query->where('company_id', auth()->id()); })->where('status', 'interviewed')->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('company.applications.accepted') }}" class="nav-link {{ request()->routeIs('company.applications.accepted') ? 'active' : '' }}">
                                <i class="fas fa-check-circle"></i>
                                <span>{{ __('sidebar.accepted') }}</span>
                                <span class="nav-badge">{{ \App\Models\Application::whereHas('job', function($query) { $query->where('company_id', auth()->id()); })->where('status', 'accepted')->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('company.applications.rejected') }}" class="nav-link {{ request()->routeIs('company.applications.rejected') ? 'active' : '' }}">
                                <i class="fas fa-times-circle"></i>
                                <span>{{ __('sidebar.rejected') }}</span>
                                <span class="nav-badge">{{ \App\Models\Application::whereHas('job', function($query) { $query->where('company_id', auth()->id()); })->where('status', 'rejected')->count() }}</span>
                            </a>
                        </li>
                    </ul>
                </div> --}}



              

            @else
                <!-- User/Job Seeker Navigation -->
                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.job_search') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('jobs.index') }}" class="nav-link">
                                <i class="fas fa-search"></i>
                                <span>{{ __('sidebar.search_jobs') }}</span>
                            </a>
                        </li>
                      
                     
                    </ul>
                </div>


            
            @endif

           
        </nav>
    </aside>
