    <!-- الشريط الجانبي الأبيض المحسن -->
    <aside class="sidebar {{ app()->getLocale() === 'ar' ? 'sidebar-rtl' : 'sidebar-ltr' }}">
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
                        <li class="nav-item">
                            <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                                <i class="fas fa-user"></i>
                                <span>{{ __('sidebar.profile') }}</span>
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
    <!-- الشريط الجانبي الأبيض المحسن -->
    <aside class="sidebar {{ app()->getLocale() === 'ar' ? 'sidebar-rtl' : 'sidebar-ltr' }}">
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
                        <li class="nav-item">
                            <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                                <i class="fas fa-user"></i>
                                <span>{{ __('sidebar.profile') }}</span>
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
                    <div class="nav-section-title">{{ __('sidebar.dashboard') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('company.dashboard') }}" class="nav-link {{ request()->routeIs('company.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>{{ __('sidebar.overview') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
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
                
                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.profile_management') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('company.profile') }}" class="nav-link {{ request()->routeIs('company.profile') ? 'active' : '' }}">
                                <i class="fas fa-user"></i>
                                <span>{{ __('sidebar.profile') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">إدارة المقابلات</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('calendar.index') }}" class="nav-link {{ request()->routeIs('calendar.*') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt"></i>
                                <span>التقويم</span>
                                <span class="nav-badge">{{ \App\Models\Calendar::where('user_id', auth()->id())->upcoming()->count() }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('calendar.selected-applicants') }}" class="nav-link {{ request()->routeIs('calendar.selected-applicants') ? 'active' : '' }}">
                                <i class="fas fa-users"></i>
                                <span>المرشحين المختارين</span>
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
                    <div class="nav-section-title">{{ __('sidebar.dashboard') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('employee.dashboard') }}" class="nav-link {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>{{ __('sidebar.overview') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.job_search') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('jobs.index') }}" class="nav-link {{ request()->routeIs('jobs.index') ? 'active' : '' }}">
                                <i class="fas fa-search"></i>
                                <span>{{ __('sidebar.search_jobs') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('applications.index') }}" class="nav-link {{ request()->routeIs('applications.*') ? 'active' : '' }}">
                                <i class="fas fa-paper-plane"></i>
                                <span>{{ __('sidebar.my_applications') }}</span>
                                <span class="nav-badge">{{ auth()->user()->applications()->count() }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.profile_management') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('employee.profile') }}" class="nav-link {{ request()->routeIs('employee.profile') ? 'active' : '' }}">
                                <i class="fas fa-user"></i>
                                <span>{{ __('sidebar.profile') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.calendar') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('calendar.index') }}" class="nav-link {{ request()->routeIs('calendar.*') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ __('sidebar.my_calendar') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>

            
            @endif

            <!-- Chat Section - Available for all roles -->
            <div class="nav-section">
                <div class="nav-section-title">{{ __('sidebar.communication') }}</div>
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('chat.index') }}" class="nav-link {{ request()->routeIs('chat.*') ? 'active' : '' }}">
                            <i class="fas fa-comments"></i>
                            <span>{{ __('sidebar.chat') }}</span>
                        </a>
                    </li>
                </ul>
            </div>

           
        </nav>
    </aside>
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
                
                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.communication') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('chat.index') }}" class="nav-link {{ request()->routeIs('chat.*') ? 'active' : '' }}">
                                <i class="fas fa-comments"></i>
                                <span>{{ __('sidebar.chat') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('calendar.index') }}" class="nav-link {{ request()->routeIs('calendar.*') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ __('sidebar.calendar') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('meetings.index') }}" class="nav-link {{ request()->routeIs('meetings.*') ? 'active' : '' }}">
                                <i class="fas fa-video"></i>
                                <span>{{ __('sidebar.meetings') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.profile_management') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('company.profile') }}" class="nav-link {{ request()->routeIs('company.profile') ? 'active' : '' }}">
                                <i class="fas fa-user"></i>
                                <span>{{ __('sidebar.profile') }}</span>
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
                    <div class="nav-section-title">{{ __('sidebar.dashboard') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('employee.dashboard') }}" class="nav-link {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>{{ __('sidebar.overview') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.job_search') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('jobs.index') }}" class="nav-link {{ request()->routeIs('jobs.index') ? 'active' : '' }}">
                                <i class="fas fa-search"></i>
                                <span>{{ __('sidebar.search_jobs') }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('applications.index') }}" class="nav-link {{ request()->routeIs('applications.*') ? 'active' : '' }}">
                                <i class="fas fa-paper-plane"></i>
                                <span>{{ __('sidebar.my_applications') }}</span>
                                <span class="nav-badge">{{ auth()->user()->applications()->count() }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">{{ __('sidebar.profile_management') }}</div>
                    <ul>
                        <li class="nav-item">
                            <a href="{{ route('employee.profile') }}" class="nav-link {{ request()->routeIs('employee.profile') ? 'active' : '' }}">
                                <i class="fas fa-user"></i>
                                <span>{{ __('sidebar.profile') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>


            
            @endif

            <!-- Chat Section - Available for all roles -->
            <div class="nav-section">
                <div class="nav-section-title">{{ __('sidebar.communication') }}</div>
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('chat.index') }}" class="nav-link {{ request()->routeIs('chat.*') ? 'active' : '' }}">
                            <i class="fas fa-comments"></i>
                            <span>{{ __('sidebar.chat') }}</span>
                        </a>
                    </li>
                </ul>
            </div>

           
        </nav>
    </aside>
