<header class="dashboard-header">
    <div class="header-left">
        <div class="breadcrumb">
            <i class="fas fa-home"></i>
            <span>{{ __('topnav.home') }}</span>
            <i class="fas fa-chevron-left"></i>
            <span>{{ __('topnav.employment_dashboard') }}</span>
        </div>
    </div>
    
    <div class="header-right">
        <div class="search-container">
            <input type="text" class="search-input" placeholder="{{ __('topnav.search_placeholder') }}">
            <i class="fas fa-search search-icon"></i>
        </div>
        
        <div class="header-actions">
            <!-- Language Switcher -->
      
            
            <button class="header-btn" title="{{ __('topnav.messages') }}">
                <i class="fas fa-envelope"></i>
                <span class="notification-badge">42</span>
            </button>
        </div>
        
        <div class="user-profile" id="userProfileDropdown">
            @php $user = auth()->user(); @endphp
            <div class="user-profile-main">
                <div class="user-avatar">
                    @if($user->profile_photo_url)
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="avatar-image">
                    @else
                        <span class="avatar-initials">{{ substr($user->name, 0, 2) }}</span>
                    @endif
                </div>
                <div class="user-info">
                    <div class="user-name">{{ $user->name }}</div>
                    <div class="user-role">
                        @switch($user->role)
                            @case('admin')
                                {{ __('topnav.admin_role') }}
                                @break
                            @case('company')
                                {{ __('topnav.company_role') }}
                                @break
                            @default
                                {{ __('topnav.employee_role') }}
                        @endswitch
                    </div>
                </div>
                <i class="fas fa-chevron-down dropdown-arrow" id="dropdownArrow"></i>
            </div>
            
            <!-- User Dropdown Menu -->
            <div class="user-dropdown" id="userDropdown">
                <div class="dropdown-header">
                    <div class="dropdown-user-info">
                        <div class="dropdown-avatar">
                            @if($user->profile_photo_url)
                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                            @else
                                <span>{{ substr($user->name, 0, 2) }}</span>
                            @endif
                        </div>
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-name">{{ $user->name }}</div>
                            <div class="dropdown-user-email">{{ $user->email }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="dropdown-menu">
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.profile') }}" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            <span>{{ __('topnav.profile') }}</span>
                        </a>
                    @elseif(auth()->user()->role === 'company')
                        <a href="{{ route('company.profile') }}" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            <span>{{ __('topnav.profile') }}</span>
                        </a>
                    @else
                        <a href="{{ route('employee.profile') }}" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            <span>{{ __('topnav.profile') }}</span>
                        </a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="dropdown-item">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>{{ __('topnav.dashboard') }}</span>
                    </a>
                    <a href="{{ route('jobs.index') }}" class="dropdown-item">
                        <i class="fas fa-briefcase"></i>
                        <span>{{ __('topnav.jobs') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}" class="dropdown-item logout-form">
                        @csrf
                        <button type="submit" class="dropdown-item logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>{{ __('topnav.logout') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
/* Language Switcher Styles */
.language-switcher {
    position: relative;
    margin-right: 1rem;
}

.language-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: #f8f9fa;
    border: 1px solid #e1e5e9;
    border-radius: 8px;
    padding: 0.5rem 0.75rem;
    color: #333;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.language-btn:hover {
    background: #e9ecef;
    border-color: #adb5bd;
}

.current-lang {
    font-weight: 500;
}

.language-dropdown {
    position: absolute;
    top: 100%;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    border: 1px solid #e1e5e9;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 9999;
    min-width: 180px;
    margin-top: 0.5rem;
    pointer-events: none;
}

.language-switcher.active .language-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    pointer-events: auto;
}

.language-option {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    color: #333;
    text-decoration: none;
    transition: all 0.2s ease;
    font-size: 0.9rem;
    border: none;
    background: none;
    width: 100%;
    cursor: pointer;
}

.language-option:hover {
    background: #f8f9fa;
    color: #667eea;
}

.language-option.active {
    background: #e3f2fd;
    color: #1976d2;
}

.language-option .flag {
    font-size: 1.2rem;
}

/* RTL/LTR Specific Styles */
.language-dropdown {
    right: 0;
    left: auto;
}

.language-option {
    text-align: right;
}

/* LTR Override */
.dashboard-layout[dir="ltr"] .language-dropdown {
    left: 0;
    right: auto;
}

.dashboard-layout[dir="ltr"] .language-option {
    text-align: left;
}

/* User Profile Styles */
.user-profile {
    position: relative;
    display: flex;
    align-items: center;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.user-profile:hover {
    background: rgba(0, 0, 0, 0.05);
}

.user-profile-main {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.avatar-image {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

.avatar-initials {
    color: white;
    font-weight: 600;
}

.user-info {
    display: flex;
    flex-direction: column;
    gap: 0.2rem;
}

.user-name {
    font-weight: 600;
    color: #333;
    font-size: 0.9rem;
}

.user-role {
    font-size: 0.75rem;
    color: #666;
}

.dropdown-arrow {
    color: #666;
    font-size: 0.8rem;
    transition: transform 0.3s ease;
    margin-right: 0.5rem;
}

.user-profile.active .dropdown-arrow {
    transform: rotate(180deg);
}

/* Dropdown Styles */
.user-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    border: 1px solid #e1e5e9;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 9999;
    min-width: 280px;
    margin-top: 0.5rem;
    pointer-events: none;
}

.user-profile.active .user-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
    pointer-events: auto;
}

.dropdown-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e1e5e9;
    background: #f8f9fa;
    border-radius: 12px 12px 0 0;
}

.dropdown-user-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.dropdown-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 1.1rem;
}

.dropdown-avatar img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

.dropdown-user-details {
    flex: 1;
}

.dropdown-user-name {
    font-weight: 600;
    color: #333;
    font-size: 1rem;
    margin-bottom: 0.2rem;
}

.dropdown-user-email {
    font-size: 0.85rem;
    color: #666;
}

.dropdown-menu {
    padding: 1rem 0;
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.5rem;
    color: #333;
    text-decoration: none;
    transition: all 0.2s ease;
    font-size: 0.9rem;
    cursor: pointer;
    border: none;
    background: none;
    width: 100%;
    text-align: right;
}

.dropdown-item:hover {
    background: #f8f9fa;
    color: #667eea;
}

.dropdown-item:active {
    background: #e9ecef;
    transform: translateY(1px);
}

.dropdown-item i {
    width: 16px;
    color: #666;
    transition: color 0.2s ease;
}

.dropdown-item:hover i {
    color: #667eea;
}

.dropdown-divider {
    height: 1px;
    background: #e1e5e9;
    margin: 0.5rem 1.5rem;
}

.logout-form {
    padding: 0;
    margin: 0;
}

.logout-btn {
    cursor: pointer;
    border: none;
    background: none;
    width: 100%;
    text-align: right;
    padding: 0.75rem 1.5rem;
    color: #333;
    transition: all 0.2s ease;
    font-size: 0.9rem;
}

.logout-btn:hover {
    background: #fff5f5;
    color: #e53e3e;
}

.logout-btn:hover i {
    color: #e53e3e;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .user-info {
        display: none;
    }
    
    .user-dropdown {
        min-width: 250px;
        right: 0;
        left: auto;
    }
    
    .language-switcher {
        margin-right: 0.5rem;
    }
    
    .current-lang {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const userProfile = document.getElementById('userProfileDropdown');
    const dropdown = document.getElementById('userDropdown');
    const languageSwitcher = document.getElementById('languageSwitcher');
    
    // Toggle user dropdown on profile click
    userProfile.addEventListener('click', function(e) {
        e.stopPropagation();
        userProfile.classList.toggle('active');
    });
    
    // Toggle language dropdown on language switcher click
    languageSwitcher.addEventListener('click', function(e) {
        e.stopPropagation();
        languageSwitcher.classList.toggle('active');
    });
    
    // Handle user dropdown item clicks
    const dropdownItems = dropdown.querySelectorAll('.dropdown-item:not(.logout-btn)');
    dropdownItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the href from the anchor tag
            const href = item.getAttribute('href');
            if (href) {
                // Close dropdown
                userProfile.classList.remove('active');
                // Navigate to the URL
                window.location.href = href;
            }
        });
    });
    
    // Handle logout form submission
    const logoutForm = dropdown.querySelector('.logout-form');
    if (logoutForm) {
        logoutForm.addEventListener('submit', function(e) {
            // Close dropdown before logout
            userProfile.classList.remove('active');
            // Form will submit normally
        });
    }
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!userProfile.contains(e.target)) {
            userProfile.classList.remove('active');
        }
        if (!languageSwitcher.contains(e.target)) {
            languageSwitcher.classList.remove('active');
        }
    });
    
    // Close dropdowns on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            userProfile.classList.remove('active');
            languageSwitcher.classList.remove('active');
        }
    });
});
</script>