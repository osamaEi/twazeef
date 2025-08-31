@extends('dashboard.index')

@section('content')
<div class="profile-page">
    <!-- Enhanced Header Section -->
    <div class="page-header enhanced-header">
        <div class="header-content">
            <div class="profile-hero">
                <div class="profile-avatar-wrapper">
                    <div class="profile-avatar">
                        @if($user->logo)
                            <img src="{{ asset('storage/' . $user->logo) }}" alt="{{ $user->company_name }}">
                        @else
                            <span>{{ strtoupper(substr($user->company_name ?? 'C', 0, 1)) }}</span>
                        @endif
                    </div>
                    <div class="profile-status-indicator {{ $user->is_active ? 'online' : 'offline' }}"></div>
                </div>
                <div class="profile-info">
                    <h1 class="profile-name">{{ $user->company_name ?? __('Company Name') }}</h1>
                    <p class="profile-title">{{ $user->business_sector ?? __('Business Sector') }}</p>
                    <div class="profile-meta">
                        <span class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $user->address ?? __('Location not set') }}
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            {{ __('Established') }} {{ $user->establishment_date ?? 'N/A' }}
                        </span>
                        <span class="meta-item">
                            <i class="fas fa-shield-check"></i>
                            {{ $user->email_verified_at ? __('Verified') : __('Unverified') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="header-actions">
                <button class="action-btn primary" data-action="edit">
                    <i class="fas fa-edit"></i>
                    <span>{{ __('Edit Profile') }}</span>
                </button>
                <button class="action-btn secondary" data-action="download">
                    <i class="fas fa-download"></i>
                    <span>{{ __('Export Data') }}</span>
                </button>
                <button class="action-btn secondary" data-action="share">
                    <i class="fas fa-share-alt"></i>
                    <span>{{ __('Share') }}</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Profile Completion Progress -->
    @php
        $completionData = [
            'basic' => !empty($user->company_name) && !empty($user->email) && !empty($user->phone),
            'business' => !empty($user->entity_type) && !empty($user->license_number) && !empty($user->establishment_date),
            'details' => !empty($user->business_sector) && !empty($user->description),
            'documents' => !empty($user->logo) || !empty($user->license_image) || !empty($user->certificate_image)
        ];
        $completedSections = array_sum($completionData);
        $totalSections = count($completionData);
        $completionPercentage = round(($completedSections / $totalSections) * 100);
    @endphp

    <div class="completion-card">
        <div class="completion-header">
            <div class="completion-info">
                <h3 class="completion-title">{{ __('Company Profile Completion') }}</h3>
                <p class="completion-subtitle">{{ $completedSections }}/{{ $totalSections }} {{ __('sections completed') }}</p>
            </div>
            <div class="completion-score">
                <div class="score-circle" data-percentage="{{ $completionPercentage }}">
                    <span class="score-text">{{ $completionPercentage }}%</span>
                </div>
            </div>
        </div>
        <div class="completion-progress">
            <div class="progress-bar">
                <div class="progress-fill" style="width: {{ $completionPercentage }}%"></div>
            </div>
            <div class="progress-indicators">
                <div class="indicator {{ $completionData['basic'] ? 'completed' : 'incomplete' }}">
                    <i class="fas {{ $completionData['basic'] ? 'fa-check-circle' : 'fa-circle' }}"></i>
                    <span>{{ __('Basic Info') }}</span>
                </div>
                <div class="indicator {{ $completionData['business'] ? 'completed' : 'incomplete' }}">
                    <i class="fas {{ $completionData['business'] ? 'fa-check-circle' : 'fa-circle' }}"></i>
                    <span>{{ __('Business Details') }}</span>
                </div>
                <div class="indicator {{ $completionData['details'] ? 'completed' : 'incomplete' }}">
                    <i class="fas {{ $completionData['details'] ? 'fa-check-circle' : 'fa-circle' }}"></i>
                    <span>{{ __('Company Details') }}</span>
                </div>
                <div class="indicator {{ $completionData['documents'] ? 'completed' : 'incomplete' }}">
                    <i class="fas {{ $completionData['documents'] ? 'fa-check-circle' : 'fa-circle' }}"></i>
                    <span>{{ __('Documents') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabbed Content Section -->
    <div class="profile-tabs-container">
        <div class="tabs-navigation">
            <button class="tab-btn active" data-tab="overview">
                <i class="fas fa-building"></i>
                <span>{{ __('Company Overview') }}</span>
                <div class="tab-indicator {{ $completionData['basic'] ? 'complete' : 'incomplete' }}"></div>
            </button>
            <button class="tab-btn" data-tab="business">
                <i class="fas fa-briefcase"></i>
                <span>{{ __('Business Details') }}</span>
                <div class="tab-indicator {{ $completionData['business'] ? 'complete' : 'incomplete' }}"></div>
            </button>
            <button class="tab-btn" data-tab="documents">
                <i class="fas fa-file-alt"></i>
                <span>{{ __('Documents') }}</span>
                <div class="tab-indicator {{ $completionData['documents'] ? 'complete' : 'incomplete' }}"></div>
            </button>
            <button class="tab-btn" data-tab="settings">
                <i class="fas fa-cog"></i>
                <span>{{ __('Settings') }}</span>
            </button>
        </div>

        <div class="tabs-content">
            <!-- Company Overview Tab -->
            <div class="tab-pane active" id="overview-tab">
                <div class="tab-header">
                    <h2 class="tab-title">{{ __('Company Overview') }}</h2>
                    <p class="tab-description">{{ __('Basic company information and contact details') }}</p>
                </div>

                <div class="content-grid">
                    <div class="info-section">
                        <h3 class="section-title">{{ __('Basic Information') }}</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <label class="info-label">{{ __('Company Name') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->company_name ?? __('Not set') }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="info-item">
                                <label class="info-label">{{ __('Email Address') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->email }}</span>
                                    @if($user->email_verified_at)
                                        <span class="verified-badge"><i class="fas fa-check-circle"></i> {{ __('Verified') }}</span>
                                    @else
                                        <span class="unverified-badge"><i class="fas fa-exclamation-circle"></i> {{ __('Unverified') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="info-item">
                                <label class="info-label">{{ __('Phone Number') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->phone ?? __('Not set') }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="info-item">
                                <label class="info-label">{{ __('Website') }}</label>
                                <div class="info-value">
                                    @if($user->website)
                                        <a href="{{ $user->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">{{ $user->website }}</a>
                                    @else
                                        <span class="value-text">{{ __('Not set') }}</span>
                                    @endif
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="section-title">{{ __('Company Description') }}</h3>
                        <div class="info-card">
                            <div class="card-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">{{ __('About Company') }}</h4>
                                <p class="card-value">{{ $user->description ?? __('No description provided') }}</p>
                                <button class="card-action">{{ __('Update Description') }}</button>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="section-title">{{ __('Account Status') }}</h3>
                        <div class="status-grid">
                            <div class="status-item">
                                <div class="status-indicator {{ $user->is_active ? 'active' : 'inactive' }}"></div>
                                <div class="status-info">
                                    <span class="status-label">{{ __('Account Status') }}</span>
                                    <span class="status-value">{{ $user->is_active ? __('Active') : __('Inactive') }}</span>
                                </div>
                            </div>
                            <div class="status-item">
                                <div class="status-indicator {{ $user->email_verified_at ? 'verified' : 'unverified' }}"></div>
                                <div class="status-info">
                                    <span class="status-label">{{ __('Email Status') }}</span>
                                    <span class="status-value">{{ $user->email_verified_at ? __('Verified') : __('Not Verified') }}</span>
                                </div>
                            </div>
                            <div class="status-item">
                                <div class="status-indicator active"></div>
                                <div class="status-info">
                                    <span class="status-label">{{ __('Member Since') }}</span>
                                    <span class="status-value">{{ $user->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Details Tab -->
            <div class="tab-pane" id="business-tab">
                <div class="tab-header">
                    <h2 class="tab-title">{{ __('Business Details') }}</h2>
                    <p class="tab-description">{{ __('Legal and business information') }}</p>
                </div>

                <div class="content-grid">
                    <div class="info-section">
                        <h3 class="section-title">{{ __('Legal Information') }}</h3>
                        <div class="info-grid">
                            <div class="info-item">
                                <label class="info-label">{{ __('Entity Type') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->entity_type ?? __('Not set') }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="info-item">
                                <label class="info-label">{{ __('License Number') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->license_number ?? __('Not set') }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="info-item">
                                <label class="info-label">{{ __('Establishment Date') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->establishment_date ?? __('Not set') }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                            <div class="info-item">
                                <label class="info-label">{{ __('Business Sector') }}</label>
                                <div class="info-value">
                                    <span class="value-text">{{ $user->business_sector ?? __('Not set') }}</span>
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-section">
                        <h3 class="section-title">{{ __('Business Certificates') }}</h3>
                        <div class="certificate-card">
                            <div class="certificate-header">
                                <i class="fas fa-award certificate-icon"></i>
                                <div class="certificate-info">
                                    <h4 class="certificate-title">{{ __('Business License') }}</h4>
                                    <p class="certificate-status">
                                        @if($user->license_image)
                                            <span class="status-uploaded">{{ __('License uploaded') }}</span>
                                        @else
                                            <span class="status-missing">{{ __('No license uploaded') }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="certificate-actions">
                                @if($user->license_image)
                                    <a href="{{ asset('storage/' . $user->license_image) }}" target="_blank" class="btn-view">
                                        <i class="fas fa-eye"></i>
                                        {{ __('View License') }}
                                    </a>
                                    <button class="btn-replace">{{ __('Replace') }}</button>
                                @else
                                    <button class="btn-upload">{{ __('Upload License') }}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documents Tab -->
            <div class="tab-pane" id="documents-tab">
                <div class="tab-header">
                    <h2 class="tab-title">{{ __('Company Documents') }}</h2>
                    <p class="tab-description">{{ __('Manage your company documents and certificates') }}</p>
                </div>

                <div class="documents-grid">
                    <div class="document-card logo-card">
                        <div class="document-header">
                            <div class="document-icon">
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="document-info">
                                <h4 class="document-title">{{ __('Company Logo') }}</h4>
                                <p class="document-description">{{ __('Your company branding') }}</p>
                            </div>
                            <div class="document-status">
                                @if($user->logo)
                                    <span class="status-badge uploaded">{{ __('Uploaded') }}</span>
                                @else
                                    <span class="status-badge missing">{{ __('Missing') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="document-actions">
                            @if($user->logo)
                                <a href="{{ asset('storage/' . $user->logo) }}" target="_blank" class="btn-action view">
                                    <i class="fas fa-eye"></i>
                                    {{ __('View') }}
                                </a>
                                <button class="btn-action download">
                                    <i class="fas fa-download"></i>
                                    {{ __('Download') }}</button>
                                <button class="btn-action replace">
                                    <i class="fas fa-sync"></i>
                                    {{ __('Replace') }}</button>
                            @else
                                <button class="btn-action upload primary">
                                    <i class="fas fa-upload"></i>
                                    {{ __('Upload Logo') }}</button>
                            @endif
                        </div>
                    </div>

                    <div class="document-card license-card">
                        <div class="document-header">
                            <div class="document-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <div class="document-info">
                                <h4 class="document-title">{{ __('Business License') }}</h4>
                                <p class="document-description">{{ __('Legal business license') }}</p>
                            </div>
                            <div class="document-status">
                                @if($user->license_image)
                                    <span class="status-badge uploaded">{{ __('Uploaded') }}</span>
                                @else
                                    <span class="status-badge missing">{{ __('Missing') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="document-actions">
                            @if($user->license_image)
                                <a href="{{ asset('storage/' . $user->license_image) }}" target="_blank" class="btn-action view">
                                    <i class="fas fa-eye"></i>
                                    {{ __('View') }}</a>
                                <button class="btn-action download">
                                    <i class="fas fa-download"></i>
                                    {{ __('Download') }}</button>
                                <button class="btn-action replace">
                                    <i class="fas fa-sync"></i>
                                    {{ __('Replace') }}</button>
                            @else
                                <button class="btn-action upload primary">
                                    <i class="fas fa-upload"></i>
                                    {{ __('Upload License') }}</button>
                            @endif
                        </div>
                    </div>

                    <div class="document-card certificate-card">
                        <div class="document-header">
                            <div class="document-icon">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div class="document-info">
                                <h4 class="document-title">{{ __('Business Certificates') }}</h4>
                                <p class="document-description">{{ __('Professional certifications') }}</p>
                            </div>
                            <div class="document-status">
                                @if($user->certificate_image)
                                    <span class="status-badge uploaded">{{ __('Uploaded') }}</span>
                                @else
                                    <span class="status-badge missing">{{ __('Missing') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="document-actions">
                            @if($user->certificate_image)
                                <a href="{{ asset('storage/' . $user->certificate_image) }}" target="_blank" class="btn-action view">
                                    <i class="fas fa-eye"></i>
                                    {{ __('View') }}</a>
                                <button class="btn-action download">
                                    <i class="fas fa-download"></i>
                                    {{ __('Download') }}</button>
                                <button class="btn-action replace">
                                    <i class="fas fa-sync"></i>
                                    {{ __('Replace') }}</button>
                            @else
                                <button class="btn-action upload primary">
                                    <i class="fas fa-upload"></i>
                                    {{ __('Upload Certificate') }}</button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="documents-summary">
                    <div class="summary-card">
                        <div class="summary-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div class="summary-content">
                            <h4 class="summary-title">{{ __('Documents Overview') }}</h4>
                            @php
                                $uploadedDocs = 0;
                                if($user->logo) $uploadedDocs++;
                                if($user->license_image) $uploadedDocs++;
                                if($user->certificate_image) $uploadedDocs++;
                                $totalDocs = 3;
                            @endphp
                            <p class="summary-stats">{{ $uploadedDocs }}/{{ $totalDocs }} {{ __('documents uploaded') }}</p>
                            <div class="summary-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ ($uploadedDocs / $totalDocs) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Tab -->
            <div class="tab-pane" id="settings-tab">
                <div class="tab-header">
                    <h2 class="tab-title">{{ __('Company Settings') }}</h2>
                    <p class="tab-description">{{ __('Manage your company account and security settings') }}</p>
                </div>

                <div class="settings-sections">
                    <!-- Profile Settings -->
                    <div class="settings-card">
                        <div class="settings-header">
                            <div class="settings-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="settings-info">
                                <h3 class="settings-title">{{ __('Company Information') }}</h3>
                                <p class="settings-description">{{ __('Update your company\'s profile information and contact details') }}</p>
                            </div>
                        </div>
                        <form method="post" action="{{ route('profile.update') }}" class="settings-form">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="company_name" class="form-label">{{ __('Company Name') }}</label>
                                <input id="company_name" name="company_name" type="text" class="form-input" value="{{ old('company_name', $user->company_name) }}" required>
                                @error('company_name')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" name="email" type="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                <input id="phone" name="phone" type="tel" class="form-input" value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="website" class="form-label">{{ __('Website') }}</label>
                                <input id="website" name="website" type="url" class="form-input" value="{{ old('website', $user->website) }}">
                                @error('website')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-save">
                                    <i class="fas fa-save"></i>
                                    {{ __('Save Changes') }}</button>
                            </div>
                        </form>
                    </div>

                    <!-- Business Details Settings -->
                    <div class="settings-card">
                        <div class="settings-header">
                            <div class="settings-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="settings-info">
                                <h3 class="settings-title">{{ __('Business Details') }}</h3>
                                <p class="settings-description">{{ __('Update your business information and legal details') }}</p>
                            </div>
                        </div>
                        <form method="post" action="{{ route('profile.update') }}" class="settings-form">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="entity_type" class="form-label">{{ __('Entity Type') }}</label>
                                <input id="entity_type" name="entity_type" type="text" class="form-input" value="{{ old('entity_type', $user->entity_type) }}">
                                @error('entity_type')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="license_number" class="form-label">{{ __('License Number') }}</label>
                                <input id="license_number" name="license_number" type="text" class="form-input" value="{{ old('license_number', $user->license_number) }}">
                                @error('license_number')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="establishment_date" class="form-label">{{ __('Establishment Date') }}</label>
                                <input id="establishment_date" name="establishment_date" type="date" class="form-input" value="{{ old('establishment_date', $user->establishment_date) }}">
                                @error('establishment_date')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="business_sector" class="form-label">{{ __('Business Sector') }}</label>
                                <input id="business_sector" name="business_sector" type="text" class="form-input" value="{{ old('business_sector', $user->business_sector) }}">
                                @error('business_sector')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">{{ __('Company Description') }}</label>
                                <textarea id="description" name="description" class="form-textarea" rows="4">{{ old('description', $user->description) }}</textarea>
                                @error('description')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-save">
                                    <i class="fas fa-save"></i>
                                    {{ __('Save Changes') }}</button>
                            </div>
                        </form>
                    </div>

                    <!-- Password Settings -->
                    <div class="settings-card">
                        <div class="settings-header">
                            <div class="settings-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="settings-info">
                                <h3 class="settings-title">{{ __('Password Security') }}</h3>
                                <p class="settings-description">{{ __('Ensure your account is using a long, random password to stay secure') }}</p>
                            </div>
                        </div>
                        <form method="post" action="{{ route('password.update') }}" class="settings-form">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                                <input id="current_password" name="current_password" type="password" class="form-input">
                                @error('current_password', 'updatePassword')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">{{ __('New Password') }}</label>
                                <input id="password" name="password" type="password" class="form-input">
                                @error('password', 'updatePassword')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-input">
                                @error('password_confirmation', 'updatePassword')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-save">
                                    <i class="fas fa-save"></i>
                                    {{ __('Update Password') }}</button>
                            </div>
                        </form>
                    </div>

                    <!-- Account Deletion -->
                    <div class="settings-card danger-zone">
                        <div class="settings-header">
                            <div class="settings-icon">
                                <i class="fas fa-trash-alt"></i>
                            </div>
                            <div class="settings-info">
                                <h3 class="settings-title">{{ __('Delete Account') }}</h3>
                                <p class="settings-description">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</p>
                            </div>
                        </div>
                        <div class="danger-actions">
                            <button type="button" class="btn-delete" data-action="delete-account">
                                <i class="fas fa-trash"></i>
                                {{ __('Delete Account') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Edit Forms -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('Edit Information') }}</h3>
                <button class="modal-close" data-action="close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="edit-form" id="editForm">
                    <div class="form-group">
                        <label class="form-label">{{ __('Field Label') }}</label>
                        <input type="text" class="form-input" id="editField" name="field_value">
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn-secondary" data-action="close-modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn-primary">{{ __('Save Changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Document Upload -->
    <div class="modal-overlay" id="uploadModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('Upload Document') }}</h3>
                <button class="modal-close" data-action="close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form class="upload-form" id="uploadForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="documentFile" class="form-label">{{ __('Select File') }}</label>
                        <input type="file" class="form-file" id="documentFile" name="document_file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                        <div class="form-help">
                            <p>{{ __('Supported formats: PDF, DOC, DOCX, JPG, JPEG, PNG') }}</p>
                            <p>{{ __('Maximum file size: 5MB') }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="documentType" class="form-label">{{ __('Document Type') }}</label>
                        <select class="form-select" id="documentType" name="document_type" required>
                            <option value="">{{ __('Select document type') }}</option>
                            <option value="logo">{{ __('Company Logo') }}</option>
                            <option value="license">{{ __('Business License') }}</option>
                            <option value="certificate">{{ __('Business Certificate') }}</option>
                        </select>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="btn-secondary" data-action="close-modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn-primary">{{ __('Upload Document') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success/Error Toast Notifications -->
    <div class="toast-container" id="toastContainer">
        <div class="toast success" id="successToast">
            <div class="toast-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast-content">
                <h4 class="toast-title">{{ __('Success!') }}</h4>
                <p class="toast-message">{{ __('Your changes have been saved successfully.') }}</p>
            </div>
            <button class="toast-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="toast error" id="errorToast">
            <div class="toast-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="toast-content">
                <h4 class="toast-title">{{ __('Error!') }}</h4>
                <p class="toast-message">{{ __('Something went wrong. Please try again.') }}</p>
            </div>
            <button class="toast-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<!-- JavaScript for Profile Functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab Navigation
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetTab = this.dataset.tab;
            
            // Remove active class from all tabs and panes
            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding pane
            this.classList.add('active');
            document.getElementById(targetTab + '-tab').classList.add('active');
        });
    });

    // Modal Management
    const modals = document.querySelectorAll('.modal-overlay');
    const modalCloseBtns = document.querySelectorAll('[data-action="close-modal"]');
    
    function openModal(modalId) {
        document.getElementById(modalId).classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('active');
        document.body.style.overflow = 'auto';
    }
    
    modalCloseBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = this.closest('.modal-overlay');
            closeModal(modal.id);
        });
    });
    
    // Close modal when clicking outside
    modals.forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal(this.id);
            }
        });
    });

    // Edit Buttons
    const editBtns = document.querySelectorAll('.edit-btn');
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const infoItem = this.closest('.info-item');
            const label = infoItem.querySelector('.info-label').textContent;
            const currentValue = infoItem.querySelector('.value-text').textContent;
            
            document.querySelector('#editModal .modal-title').textContent = `Edit ${label}`;
            document.querySelector('#editField').value = currentValue;
            document.querySelector('#editField').name = label.toLowerCase().replace(/\s+/g, '_');
            
            openModal('editModal');
        });
    });

    // Document Upload Buttons
    const uploadBtns = document.querySelectorAll('.btn-upload');
    uploadBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const documentCard = this.closest('.document-card');
            const documentType = documentCard.classList.contains('logo-card') ? 'logo' : 
                               documentCard.classList.contains('license-card') ? 'license' : 'certificate';
            
            document.querySelector('#documentType').value = documentType;
            openModal('uploadModal');
        });
    });

    // Form Submissions
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show success toast (in real app, this would handle actual form submission)
            showToast('success', 'Your changes have been saved successfully.');
            
            // Close modal if it's open
            const modal = this.closest('.modal-overlay');
            if (modal) {
                closeModal(modal.id);
            }
        });
    });

    // Toast Notifications
    function showToast(type, message) {
        const toast = document.getElementById(type + 'Toast');
        const messageEl = toast.querySelector('.toast-message');
        
        messageEl.textContent = message;
        toast.classList.add('show');
        
        setTimeout(() => {
            toast.classList.remove('show');
        }, 5000);
    }

    // Toast Close Buttons
    const toastCloseBtns = document.querySelectorAll('.toast-close');
    toastCloseBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const toast = this.closest('.toast');
            toast.classList.remove('show');
        });
    });

    // Profile Completion Animation
    const scoreCircle = document.querySelector('.score-circle');
    if (scoreCircle) {
        const percentage = scoreCircle.dataset.percentage;
        const circumference = 2 * Math.PI * 45; // Assuming radius of 45
        
        scoreCircle.style.setProperty('--circumference', circumference);
        scoreCircle.style.setProperty('--percentage', percentage);
    }

    // Action Buttons
    const actionBtns = document.querySelectorAll('.action-btn');
    actionBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const action = this.dataset.action;
            
            switch(action) {
                case 'edit':
                    // Switch to settings tab
                    document.querySelector('[data-tab="settings"]').click();
                    break;
                case 'download':
                    // Handle data export
                    showToast('success', 'Company data export started.');
                    break;
                case 'share':
                    // Handle company sharing
                    if (navigator.share) {
                        navigator.share({
                            title: '{{ $user->company_name }} - Company Profile',
                            url: window.location.href
                        });
                    } else {
                        // Fallback: copy to clipboard
                        navigator.clipboard.writeText(window.location.href);
                        showToast('success', 'Company profile link copied to clipboard!');
                    }
                    break;
            }
        });
    });
});
</script>

@endsection
