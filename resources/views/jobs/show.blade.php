@extends('layouts.job-show')

@section('title', $job->title . ' | منصة توافق')

@section('content')
    <!-- قسم عرض الوظيفة الرئيسي -->
    <section class="project-hero">
        <div class="container">
            <div class="project-hero-content">
                <div>
                    <div class="project-meta">
                        <span class="project-category">
                            <i class="fas fa-briefcase"></i>
                            {{ $job->getFormattedTypeAttribute() }}
                        </span>
                        <span class="project-id">رقم الوظيفة: {{ $job->id }}</span>
                    </div>
                    
                    <h1 class="project-title">{{ $job->title }}</h1>
                    
                    <p class="project-summary">
                        {{ Str::limit($job->description, 200) }}
                    </p>
                    
                    <div class="project-highlights">
                        <div class="highlight-item">
                            <div class="highlight-value">{{ $job->getFormattedSalaryAttribute() }}</div>
                            <div class="highlight-label">الراتب</div>
                        </div>
                        <div class="highlight-item">
                            <div class="highlight-value">{{ $job->getFormattedExperienceAttribute() }}</div>
                            <div class="highlight-label">مستوى الخبرة</div>
                        </div>
                        <div class="highlight-item">
                            <div class="highlight-value">{{ $job->location ?? 'غير محدد' }}</div>
                            <div class="highlight-label">الموقع</div>
                        </div>
                    </div>
                </div>
                
                <div>
                    @if($job->hasImage())
                        <img src="{{ asset('storage/'.$job->image) }}" class="project-image" alt="{{ $job->title }}">
                    @else
                        <img src="{{ asset('7.png') }}" class="project-image" alt="{{ $job->title }}">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- المحتوى الرئيسي -->
    <div class="container">
        <div class="main-content">
            <!-- منطقة التبويبات -->
            <div class="tabs-section">
                <div class="tabs-nav">
                    <button class="tab-btn active" data-tab="description"><span>وصف الوظيفة</span></button>
                    <button class="tab-btn" data-tab="requirements"><span>المتطلبات</span></button>
                    <button class="tab-btn" data-tab="benefits"><span>المزايا</span></button>
                    <button class="tab-btn" data-tab="company"><span>معلومات الشركة</span></button>
                </div>
                
                <div id="description" class="tab-content active">
                    <h3>نظرة عامة على الوظيفة</h3>
                    <p>
                        {!! nl2br(e($job->description)) !!}
                    </p>
                    
                    @if($job->skills && count($job->skills) > 0)
                        <h3>المهارات المطلوبة</h3>
                        <ul>
                            @foreach($job->skills as $skill)
                                <li>{{ $skill }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                
                <div id="requirements" class="tab-content">
                    <h3>المتطلبات الأساسية للمشاركة</h3>
                    
                    <h4 style="color: var(--primary-green); margin: 2rem 0 1rem;">المتطلبات العملية</h4>
                    <ul>
                        <li>خبرة في {{ $job->getFormattedExperienceAttribute() }}</li>
                        <li>خبرة في مجال {{ $job->title }}</li>
                    </ul>
                    
                    <h4 style="color: var(--primary-green); margin: 2rem 0 1rem;">المتطلبات التقنية</h4>
                    <ul>
                        @if($job->skills && count($job->skills) > 0)
                            @foreach(array_slice($job->skills, 0, 4) as $skill)
                                <li>خبرة في {{ $skill }}</li>
                            @endforeach
                        @else
                            <li>خبرة في البرمجة</li>
                            <li>خبرة في التطوير</li>
                            <li>خبرة في إدارة المشاريع</li>
                            <li>خبرة في العمل الجماعي</li>
                        @endif
                    </ul>
                    
                    <h4 style="color: var(--primary-green); margin: 2rem 0 1rem;">المتطلبات القانونية</h4>
                    <ul>
                        <li>تسجيل الموظف في المملكة العربية السعودية</li>
                        <li>عدم وجود مخالفات قانونية أو إجراءات قضائية معلقة</li>
                        <li>الحصول على التراخيص والموافقات المطلوبة</li>
                        <li>التعهد بالالتزام بمعايير الحوكمة والشفافية</li>
                    </ul>
                </div>
                
                <div id="benefits" class="tab-content">
                    <h3>المزايا والفوائد</h3>
                    
                    @if($job->benefits && count($job->benefits) > 0)
                        <h4 style="color: var(--primary-green); margin: 2rem 0 1rem;">المزايا المقدمة</h4>
                        <ul>
                            @foreach($job->benefits as $benefit)
                                <li>{{ $benefit }}</li>
                            @endforeach
                        </ul>
                    @else
                        <h4 style="color: var(--primary-green); margin: 2rem 0 1rem;">المزايا المقدمة</h4>
                        <ul>
                            <li>راتب تنافسي ومزايا مالية مجزية</li>
                            <li>تأمين صحي شامل للعائلة</li>
                            <li>إجازة سنوية مدفوعة الأجر</li>
                            <li>فرص التطوير المهني والتدريب</li>
                            <li>بيئة عمل محفزة ومريحة</li>
                            <li>مزايا إضافية حسب الأداء</li>
                        </ul>
                    @endif
                    
                    <h4 style="color: var(--primary-green); margin: 2rem 0 1rem;">فرص النمو</h4>
                    <ul>
                        <li>تطوير المهارات المهنية والتقنية</li>
                        <li>فرص الترقية والتقدم الوظيفي</li>
                        <li>مشاركة في مشاريع متنوعة ومتطورة</li>
                        <li>شبكة علاقات مهنية واسعة</li>
                    </ul>
                </div>
                
                <div id="company" class="tab-content">
                    <h3>معلومات الشركة</h3>
                    
                    @if($job->company)
                        <h4 style="color: var(--primary-green); margin: 2rem 0 1rem;">الشركة المعلنة</h4>
                        <p>
                            <strong>اسم الشركة:</strong> {{ $job->company->company_name ?? $job->company->name ?? 'غير محدد' }}<br>
                            <strong>المجال:</strong> {{ $job->company->company_field ?? 'غير محدد' }}<br>
                            <strong>حجم الشركة:</strong> {{ $job->company->company_size ?? 'غير محدد' }}
                        </p>
                        
                        @if($job->company->company_description)
                            <h4 style="color: var(--primary-green); margin: 2rem 0 1rem;">نبذة عن الشركة</h4>
                            <p>{{ $job->company->company_description }}</p>
                        @endif
                    @else
                        <p>معلومات الشركة غير متاحة حالياً.</p>
                    @endif
                    
                    <h4 style="color: var(--primary-green); margin: 2rem 0 1rem;">ثقافة الشركة</h4>
                    <ul>
                        <li>بيئة عمل ديناميكية ومحفزة</li>
                        <li>تركيز على الابتكار والتطوير المستمر</li>
                        <li>قيم الشركة: الشفافية، النزاهة، التميز</li>
                        <li>دعم العمل الجماعي والتعاون</li>
                    </ul>
                </div>
            </div>

            <!-- الشريط الجانبي -->
            <div class="sidebar">
                <!-- معلومات الوظيفة -->
                <div class="sidebar-card">
                    <h3>
                        <i class="fas fa-info-circle"></i>
                        معلومات الوظيفة
                    </h3>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-dollar-sign"></i>
                            الراتب
                        </span>
                        <span class="info-value">{{ $job->getFormattedSalaryAttribute() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-briefcase"></i>
                            نوع الوظيفة
                        </span>
                        <span class="info-value">{{ $job->getFormattedTypeAttribute() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-chart-line"></i>
                            مستوى الخبرة
                        </span>
                        <span class="info-value">{{ $job->getFormattedExperienceAttribute() }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-map-marker-alt"></i>
                            الموقع
                        </span>
                        <span class="info-value">{{ $job->location ?? 'غير محدد' }}</span>
                    </div>
                    @if($job->company)
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-building"></i>
                                الشركة
                            </span>
                            <span class="info-value">{{ $job->company->company_name ?? $job->company->name ?? 'غير محدد' }}</span>
                        </div>
                    @endif
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-calendar-plus"></i>
                            تاريخ الإعلان
                        </span>
                        <span class="info-value">{{ $job->created_at->format('d/m/Y') }}</span>
                    </div>
                    @if($job->expires_at)
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-calendar-times"></i>
                                آخر موعد للتقديم
                            </span>
                            <span class="info-value">{{ $job->expires_at->format('d/m/Y') }}</span>
                        </div>
                    @endif
                </div>

                <!-- الفئة المستهدفة -->
                <div class="sidebar-card">
                    <h3>
                        <i class="fas fa-users"></i>
                        الفئة المستهدفة
                    </h3>
                    <div class="target-audience">
                        @if($job->experience_level)
                            @switch($job->experience_level)
                                @case('entry')
                                    <span class="audience-tag">المبتدئون</span>
                                    @break
                                @case('mid')
                                    <span class="audience-tag">المتوسطون</span>
                                    @break
                                @case('senior')
                                    <span class="audience-tag">الخبراء</span>
                                    @break
                                @case('executive')
                                    <span class="audience-tag">التنفيذيون</span>
                                    @break
                                @default
                                    <span class="audience-tag">جميع المستويات</span>
                            @endswitch
                        @else
                            <span class="audience-tag">جميع المستويات</span>
                        @endif
                        
                        @if($job->type)
                            @switch($job->type)
                                @case('full-time')
                                    <span class="audience-tag">دوام كامل</span>
                                    @break
                                @case('part-time')
                                    <span class="audience-tag">دوام جزئي</span>
                                    @break
                                @case('contract')
                                    <span class="audience-tag">عقود مؤقتة</span>
                                    @break
                                @case('freelance')
                                    <span class="audience-tag">العمل الحر</span>
                                    @break
                            @endswitch
                        @endif
                    </div>
                </div>

                <!-- تقدم التقديمات -->
                <div class="sidebar-card progress-card">
                    <h3>
                        <i class="fas fa-chart-line"></i>
                        تقدم التقديمات
                    </h3>
                    <div class="progress-info">
                        <div class="applications-count">{{ $job->applications()->count() }}</div>
                        <div class="applications-label">طلب مقدم</div>
                    </div>
                    <div class="progress-bar">
                        @php
                            $applicationsCount = $job->applications()->count();
                            $progressPercentage = min(($applicationsCount / 100) * 100, 100);
                        @endphp
                        <div class="progress-fill" style="width: {{ $progressPercentage }}%"></div>
                    </div>
                    <div class="progress-text">{{ $progressPercentage }}% من الهدف المطلوب</div>
                </div>

                <!-- معلومات التواصل -->
                <div class="sidebar-card">
                    <h3>
                        <i class="fas fa-headset"></i>
                        التواصل والدعم
                    </h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <div class="contact-label">الهاتف الموحد</div>
                                <div class="contact-value">+966-11-456-7890</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <div class="contact-label">البريد الإلكتروني</div>
                                <div class="contact-value">jobs@tawafuq.com</div>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="contact-details">
                                <div class="contact-label">أوقات العمل</div>
                                <div class="contact-value">الأحد - الخميس<br>8:00 - 17:00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- زر التقديم -->
                @auth
                    @if(auth()->user()->role === 'employee')
                        @if($job->hasUserApplied(auth()->id()))
                            <button class="apply-btn" style="background: #28a745;" disabled>
                                <i class="fas fa-check"></i>
                                تم التقديم مسبقاً
                            </button>
                        @else
                            <a href="{{ route('applications.create', ['job' => $job->id]) }}" class="apply-btn">
                                <i class="fas fa-paper-plane"></i>
                                التقديم على الوظيفة
                            </a>
                        @endif
                    @else
                        <button class="apply-btn" style="background: #6c757d;" disabled>
                            <i class="fas fa-info-circle"></i>
                            متاح للموظفين فقط
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="apply-btn">
                        <i class="fas fa-sign-in-alt"></i>
                        تسجيل الدخول للتقديم
                    </a>
                @endauth
            </div>
        </div>
    </div>
@endsection
