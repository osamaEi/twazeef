<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة توافق | الشراكة الاستراتيجية</title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏛️</text></svg>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.cdnfonts.com/css/neo-sans-arabic" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
 
</head>

<body>
    <!-- الشريط العلوي المحسن -->
    <div class="gov-top-bar">
        <div class="gov-top-content">
            <div class="gov-left-info">
                <div class="gov-official-badge">
                    <div class="gov-flag">
                        <img width="32" height="23" decoding="async" data-nimg="1" style="margin-right: -10px;margin-top: 5px;" src="https://my.gov.sa/_next/static/media/icon_saudi.b4b403e4.svg">
                    </div>
                    <span>موقع رسمي لمنصة توافق للبحث عن الوظائف في المملكة العربية والسعودية</span>
                </div>
                <div class="gov-date">
                    <i class="far fa-calendar-alt"></i>
                    <span>السبت، 15 صفر 1447 هـ</span>
                </div>
                <div class="gov-date-mobile">
                    <div class="gov-date">
                        <i class="far fa-calendar-alt"></i>
                        <span>السبت، 15 صفر 1447 هـ</span>
                    </div>
                    <div class="beta-badge">
                        نسخة تجريبية
                    </div>
                </div>
            </div>
            <div class="beta-badge">
                نسخة تجريبية
            </div>
        </div>
    </div>

    <!-- شريط التنقل -->
    <header id="navbar">
        <div class="container nav-container">
            <a href="#hero" class="nav-logo">
                <img src="elaf.png" width="300">
            </a>
            
            <nav class="nav-menu" id="navMenu">
                <a href="#hero" class="nav-link active">الرئيسية</a>
                <a href="#services" class="nav-link">الخدمات</a>
                <a href="#golden-opportunities" class="nav-link">الفرص الوظيفية</a>
                <a href="#success-stories" class="nav-link">النماذج الملهمة</a>
                <a href="#dashboard" class="nav-link">المؤشرات</a>
                <a style="color: #fff; background: #003858; padding: 0.7rem 0.6rem; border-radius: 10px" href="{{ route('register') }}" class="nav-link">الدخول للمنصة</a>
            </nav>

            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="القائمة">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <main>
        <!-- قسم البطل -->
        <section id="hero">
            <img src="flags.png" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1;">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-badge">
                        <span>منصة التوظيف الأولى</span>
                    </div>
                    
                    <h1 class="hero-title">
                        شراكة استراتيجية
                        <br>
                        <span class="highlight" style="z-index: 1000;">بين الشركات والموظفين</span>
                    </h1>
                    
                    <p class="hero-subtitle">
                        عبارة بسيطة يتم وضعها هنا تكون كوصف ( الأفضل أن يتم تركها للعميل الأساسي للتعديل عليها كما يشاء )
                    </p>
                    
                    <div class="hero-buttons">
                        <a href="#golden-opportunities" class="btn btn-primary" id="exp-btn">
                            <i class="fas fa-gem"></i>
                            <span>استكشف الفرص الوظيفية</span>
                        </a>
                        <a href="#journey" class="btn btn-secondary" id="start-btn">
                            <i class="fas fa-rocket"></i>
                            <span>ابدأ رحلة العمل</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

<!-- قسم الخدمات -->
<section id="services" style="background: var(--pure-white); padding: 120px 0; margin-bottom: -80px;">
    <div class="container">
        <div class="section-header" style="text-align: center; margin-bottom: 4rem;">
            <div class="section-badge">
                <i class="fas fa-cogs"></i>
                خدماتنا الوظيفية
            </div>
            <h2 class="section-title">خدمات متميزة لدعم رحلتك الوظيفية</h2>
            <p class="section-subtitle">
                مجموعة شاملة من الخدمات الوظيفية المتخصصة لضمان نجاح عملك
            </p>
        </div>
            <style>
                .service-icon {
                    width: 80px;
                    height: 80px;
                    background: var(--primary-lighter);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 1.5rem;
                    color: var(--primary-green);
                    font-size: 2rem;
                }
                .service-card {
                    background: var(--pure-white);
                    border-radius: var(--border-radius-lg);
                    padding: 2.5rem 2rem;
                    text-align: center;
                    transition: var(--transition-medium);
                    border: 1px solid var(--grey-100);
                    position: relative;
                    overflow: hidden;
                    box-shadow: var(--shadow-xl);
                    flex: 1 1 280px;
                    max-width: 320px;
                    cursor: pointer;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }
                .service-card:hover {
                    transform: translateY(-8px);
                    box-shadow: var(--shadow-xl);
                    border-color: var(--primary-lighter);
                }
                .service-title {
                    font-size: 1.4rem;
                    color: var(--primary-darker);
                    margin-bottom: 1rem;
                    font-weight: 700;
                    min-height: 3rem;
                }
                .service-subtitle {
                    background: var(--primary-lightest);
                    color: var(--primary-green);
                    padding: 0.75rem 1.5rem;
                    border-radius: 20px;
                    font-size: 0.9rem;
                    font-weight: 600;
                    margin-bottom: 1.5rem;
                    display: inline-block;
                    border: 2px solid var(--primary-lighter);
                    white-space: nowrap;
                }
                .service-desc {
                    color: var(--grey-700);
                    line-height: 1.7;
                    margin-bottom: 2rem;
                    font-size: 1rem;
                    flex-grow: 1;
                }
                .service-button {
                    background: var(--gradient-primary);
                    color: var(--pure-white);
                    border: none;
                    padding: 1rem 2rem;
                    border-radius: 25px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: var(--transition-medium);
                    font-family: var(--font-main);
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    gap: 0.5rem;
                    text-decoration: none;
                }
                .service-button:hover {
                    transform: translateY(-2px);
                    box-shadow: var(--shadow-lg);
                }
            </style>
<div style="display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap;">
    <a href="auth" class="service-card" tabindex="0">
        <div class="service-icon">
            <i class="fas fa-building"></i>
        </div>
        <h3 class="service-title">تسجيل الموظفين</h3>
        <div class="service-subtitle">
            للموظفين والأفراد
        </div>
        <p class="service-desc">
            تمكّن هذه الخدمة الأفراد من إنشاء حساب وظيفي والتسجيل في قاعدة بيانات التوظيف لتسهيل الحصول على فرص عمل مناسبة.
        </p>
        <span class="service-button" role="button">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> ابدأ الخدمة
        </span>
    </a>

    <a href="auth" class="service-card" tabindex="0">
        <div class="service-icon">
            <i class="fas fa-briefcase"></i>
        </div>
        <h3 class="service-title">خدمات الموظفين</h3>
        <div class="service-subtitle">
            للموظفين والأفراد
        </div>
        <p class="service-desc">
            منصة توفر خدمات وظيفية متكاملة مثل متابعة طلبات التوظيف، تحديث السيرة الذاتية، وإدارة الملف الشخصي بسهولة.
        </p>
        <span class="service-button" role="button">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> ابدأ الخدمة
        </span>
    </a>

    <a href="auth" class="service-card" tabindex="0">
        <div class="service-icon">
            <i class="fas fa-building-circle-arrow-right"></i>
        </div>
        <h3 class="service-title">نشر الوظائف</h3>
        <div class="service-subtitle">
            لجهات الأعمال
        </div>
        <p class="service-desc">
            تتيح هذه الخدمة للشركات والجهات الحكومية نشر إعلانات الوظائف المتاحة وإدارة طلبات المتقدمين بشكل منظم وسهل.
        </p>
        <span class="service-button" role="button">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> ابدأ الخدمة
        </span>
    </a>

    <a href="auth" class="service-card" tabindex="0">
        <div class="service-icon">
            <i class="fas fa-headset"></i>
        </div>
        <h3 class="service-title">الدعم الفني</h3>
        <div class="service-subtitle">
            للجميع
        </div>
        <p class="service-desc">
            خدمة مساندة للمستخدمين وأصحاب الأعمال، تشمل المساعدة في استخدام النظام، حل المشكلات، وتقديم استشارات متعلقة بالتوظيف.
        </p>
        <span class="service-button" role="button">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> ابدأ الخدمة
        </span>
    </a>
</div>

    </div>
</section>


        <!-- الفرص الذهبية -->
<section id="golden-opportunities">
    <div class="container">
        <div class="section-header" style="text-align: center; margin-bottom: 4rem;">
            <div class="section-badge">
                <i class="fas fa-gem"></i>
                الفرص الوظيفية
            </div>
            <h2 class="section-title">وظائف ذهبية بعوائد مميزة</h2>
            <p class="section-subtitle">
                فرص وظيفية استثنائية مقدمة من جهات حكومية وخاصة، تتيح لك الانضمام إلى مشاريع كبرى ومجالات متنوعة مع مستقبل واعد.
            </p>
        </div>
        
        <div class="opportunities-grid">
            @forelse($topJobs as $job)
                <div class="opportunity-card">
                    <div class="opportunity-image">
                        @if($job->hasImage())
                            <img src="{{ asset('storage/'.$job->image) }}" alt="{{ $job->title }}">
                        @else
                            <img src="7.png" alt="{{ $job->title }}">
                        @endif
                    </div>
                    <div class="opportunity-content">
                        <div class="opportunity-category" style="margin-top: -20px;width: 150px;margin-bottom: 10px;margin-right: -20px;">
                            <i class="fas fa-briefcase"></i>
                            <span>{{ $job->company->company_name ?? 'شركة خاصة' }}</span>
                        </div>
                        <h3 class="opportunity-title">{{ $job->title }}</h3>                            
                        <p class="opportunity-desc">
                            {{ \Illuminate\Support\Str::limit($job->description, 150) }}
                        </p>
                        <div class="meta-item" style="border: 3px solid #003655;background: var(--primary-lighter)">
                            <div class="meta-label">الراتب المتوقع</div>
                            <div class="meta-value">{{ $job->formatted_salary }}</div>
                        </div>
                        <br>
                        <div class="opportunity-meta">
                            <div class="meta-item">
                                <div class="meta-label">نوع العقد</div>
                                <div class="meta-value">{{ $job->formatted_type }}</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">سنوات الخبرة</div>
                                <div class="meta-value">{{ $job->formatted_experience }}</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">الموقع</div>
                                <div class="meta-value">{{ $job->location }}</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-label">الجهة المشرفة</div>
                                <div class="meta-value">{{ $job->company->company_name ?? 'شركة خاصة' }}</div>
                            </div>
                        </div>
                        <a href="{{ route('jobs.show', $job) }}">
                        <button style="font-size: 16px; margin-top: 20px; background: var(--primary-lighter); color: var(--primary-green); border: none; padding: 1.4rem 2rem; border-radius: 12px; font-weight: 600; cursor: pointer; transition: var(--transition-medium); width: 100%; font-family: var(--font-main); transform: translateY(0px); box-shadow: none;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--shadow-lg)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        <span style="margin-right: 0.5rem;">التقديم على الوظيفة</span>
                        </button>
                        </a>
                    </div>
                </div>
            @empty
                <div class="opportunity-card" style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                    <div class="opportunity-content">
                        <i class="fas fa-search" style="font-size: 3rem; color: #ccc; margin-bottom: 1rem;"></i>
                        <h3>لا توجد وظائف متاحة حالياً</h3>
                        <p>يرجى العودة لاحقاً للاطلاع على أحدث الفرص الوظيفية</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>


        <!-- النماذج الملهمة -->
<section id="success-stories">
    <div class="container">
        <div class="section-header" style="text-align: center; margin-bottom: 4rem;">
            <div class="section-badge">
                <i class="fas fa-briefcase"></i>
                أفضل الوظائف
            </div>
            <h2 class="section-title">نماذج من أفضل الوظائف المتاحة</h2>
            <p class="section-subtitle">
                مجموعة من أبرز الفرص الوظيفية المرموقة التي توفر رواتب مجزية، بيئة عمل احترافية، ومسار وظيفي يفتح لك آفاق المستقبل.
            </p>
        </div>
        <div class="opportunities-grid">
            <div class="opportunity-card">
                <div class="opportunity-image">
                    <img src="7.png">
                </div>
                <div class="opportunity-content">
                    <h3 class="opportunity-title">مدير مشروع إنشائي</h3>                            
                    <p class="opportunity-desc">
                        وظيفة قيادية في مجال الإشراف على مشاريع البنية التحتية، تتطلب خبرة واسعة في إدارة الفرق والميزانيات وضمان الجودة وفق المعايير العالمية.
                    </p>
                    <div class="story-stats">
                        <div class="story-stat">
                            <div class="story-stat-value">+25,000</div>
                            <div class="story-stat-label">الراتب الشهري</div>
                        </div>
                        <div class="story-stat">
                            <div class="story-stat-value">3500</div>
                            <div class="story-stat-label">متقدم للوظيفة</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="opportunity-card">
                <div class="opportunity-image">
                    <img src="7.png">
                </div>
                <div class="opportunity-content">
                    <h3 class="opportunity-title">محلل نظم معلومات</h3>
                    <p class="opportunity-desc">
                        وظيفة تقنية مميزة تشمل تحليل احتياجات الأنظمة الحكومية والتجارية، تصميم الحلول البرمجية، ودعم عمليات التحول الرقمي.
                    </p>
                    <div class="story-stats">
                        <div class="story-stat">
                            <div class="story-stat-value">+18,000</div>
                            <div class="story-stat-label">الراتب الشهري</div>
                        </div>
                        <div class="story-stat">
                            <div class="story-stat-value">2200</div>
                            <div class="story-stat-label">متقدم للوظيفة</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="opportunity-card">
                <div class="opportunity-image">
                    <img src="7.png">
                </div>
                <div class="opportunity-content">
                    <h3 class="opportunity-title">طيار مدني</h3>
                    <p class="opportunity-desc">
                        وظيفة مرموقة في مجال الطيران المدني، تتطلب تدريباً متخصصاً وخبرة في قيادة الطائرات، مع مزايا مهنية وحوافز استثنائية.
                    </p>
                    <div class="story-stats">
                        <div class="story-stat">
                            <div class="story-stat-value">+30,000</div>
                            <div class="story-stat-label">الراتب الشهري</div>
                        </div>
                        <div class="story-stat">
                            <div class="story-stat-value">1200</div>
                            <div class="story-stat-label">متقدم للوظيفة</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





    </main>

    <!-- الفوتر -->
<footer style="background: var(--primary-darkest); color: var(--pure-white); padding: 80px 0 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 3rem; margin-bottom: 3rem;">
            <!-- قسم المنصة -->
            <div>
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
                    <div>
                        <img src="elaf1.png" width="280">
                    </div>
                </div>
                <p style="color: rgba(255, 255, 255, 0.8); line-height: 1.7; margin-bottom: 2rem; font-size: 1.05rem;">
                    توافق هي منصة توظيف حديثة تهدف إلى ربط أصحاب العمل بالكفاءات المميزة، وتسهيل الوصول إلى فرص عمل نوعية في مختلف المجالات والقطاعات.
                </p>
                
                <!-- إحصائيات الفوتر -->
                <div style="background: rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: var(--border-radius-md); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <h4 style="color: var(--saudi-gold); margin-bottom: 1rem; font-size: 1.1rem;">إحصائيات المنصة</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div style="text-align: center;">
                            <div style="font-size: 1.8rem; font-weight: 600; color: var(--pure-white);">12.5M+</div>
                            <div style="font-size: 0.85rem; color: rgba(255, 255, 255, 0.7);">باحث عن عمل</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 1.8rem; font-weight: 600; color: var(--pure-white);">99.8%</div>
                            <div style="font-size: 0.85rem; color: rgba(255, 255, 255, 0.7);">معدل نجاح التوظيف</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- الخدمات -->
            <div>
                <h3 style="font-size: 1.2rem; margin-bottom: 1.5rem; color: var(--pure-white); position: relative; padding-bottom: 0.5rem;">
                    خدمات المنصة
                </h3>
                <div style="position: absolute; bottom: 0; right: 0; width: 40px; height: 3px; background: var(--primary-green);"></div>
                
                <ul style="list-style: none; display: grid; gap: 0.75rem;">
                    <li><a href="#" style="color: rgba(255, 255, 255, 0.8); display: flex; align-items: center; gap: 0.75rem; transition: var(--transition-fast); text-decoration: none; font-size: 1rem;" onmouseover="this.style.color='var(--pure-white)'; this.style.transform='translateX(-5px)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.transform='translateX(0)'">
                        <i class="fas fa-gem" style="color: var(--primary-light);"></i>
                        استعراض الوظائف المميزة
                    </a></li>
                    <li><a href="#" style="color: rgba(255, 255, 255, 0.8); display: flex; align-items: center; gap: 0.75rem; transition: var(--transition-fast); text-decoration: none; font-size: 1rem;" onmouseover="this.style.color='var(--pure-white)'; this.style.transform='translateX(-5px)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.transform='translateX(0)'">
                        <i class="fas fa-building" style="color: var(--primary-light);"></i>
                        تسجيل الشركات وأصحاب العمل
                    </a></li>
                    <li><a href="#" style="color: rgba(255, 255, 255, 0.8); display: flex; align-items: center; gap: 0.75rem; transition: var(--transition-fast); text-decoration: none; font-size: 1rem;" onmouseover="this.style.color='var(--pure-white)'; this.style.transform='translateX(-5px)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.transform='translateX(0)'">
                        <i class="fas fa-file-contract" style="color: var(--primary-light);"></i>
                        إدارة إعلانات التوظيف
                    </a></li>
                    <li><a href="#" style="color: rgba(255, 255, 255, 0.8); display: flex; align-items: center; gap: 0.75rem; transition: var(--transition-fast); text-decoration: none; font-size: 1rem;" onmouseover="this.style.color='var(--pure-white)'; this.style.transform='translateX(-5px)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.transform='translateX(0)'">
                        <i class="fas fa-shield-alt" style="color: var(--primary-light);"></i>
                        دعم وتوثيق الحسابات
                    </a></li>
                    <li><a href="#" style="color: rgba(255, 255, 255, 0.8); display: flex; align-items: center; gap: 0.75rem; transition: var(--transition-fast); text-decoration: none; font-size: 1rem;" onmouseover="this.style.color='var(--pure-white)'; this.style.transform='translateX(-5px)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.transform='translateX(0)'">
                        <i class="fas fa-headset" style="color: var(--primary-light);"></i>
                        الدعم الفني المباشر
                    </a></li>
                </ul>
            </div>

            <!-- معلومات الاتصال -->
            <div>
                <h3 style="font-size: 1.2rem; margin-bottom: 1.5rem; color: var(--pure-white); position: relative; padding-bottom: 0.5rem;">
                    تواصل معنا
                </h3>
                
                <ul style="list-style: none; display: grid; gap: 1rem;">
                    <li style="display: flex; align-items: center; gap: 1rem; color: rgba(255, 255, 255, 0.8); font-size: 1rem;">
                        <div style="width: 40px; height: 40px; background: rgba(0, 69, 109, 0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary-light); flex-shrink: 0;">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <div style="font-weight: 600; color: var(--pure-white); margin-bottom: 0.2rem;">الهاتف</div>
                            <div>+966-11-456-7890</div>
                        </div>
                    </li>
                    <li style="display: flex; align-items: center; gap: 1rem; color: rgba(255, 255, 255, 0.8); font-size: 1rem;">
                        <div style="width: 40px; height: 40px; background: rgba(0, 69, 109, 0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary-light); flex-shrink: 0;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <div style="font-weight: 600; color: var(--pure-white); margin-bottom: 0.2rem;">البريد الإلكتروني</div>
                            <div>info@tawafuq.com</div>
                        </div>
                    </li>
                    <li style="display: flex; align-items: center; gap: 1rem; color: rgba(255, 255, 255, 0.8); font-size: 1rem;">
                        <div style="width: 40px; height: 40px; background: rgba(0, 69, 109, 0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary-light); flex-shrink: 0;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <div style="font-weight: 600; color: var(--pure-white); margin-bottom: 0.2rem;">أوقات العمل</div>
                            <div>الأحد - الخميس: 8:00 - 17:00</div>
                        </div>
                    </li>
                </ul>

                <!-- وسائل التواصل -->
                <div style="margin-top: 2rem;">
                    <h4 style="color: var(--saudi-gold); margin-bottom: 1rem; font-size: 1rem;">تابعنا على</h4>
                    <div style="display: flex; gap: 1rem;">
                        <a href="#" style="width: 45px; height: 45px; background: rgba(255, 255, 255, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--pure-white); text-decoration: none; transition: var(--transition-medium); backdrop-filter: blur(10px);" 
                           onmouseover="this.style.background='var(--primary-light)'; this.style.transform='translateY(-3px)'" 
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.transform='translateY(0)'">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" style="width: 45px; height: 45px; background: rgba(255, 255, 255, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--pure-white); text-decoration: none; transition: var(--transition-medium); backdrop-filter: blur(10px);" 
                           onmouseover="this.style.background='var(--primary-light)'; this.style.transform='translateY(-3px)'" 
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.transform='translateY(0)'">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" style="width: 45px; height: 45px; background: rgba(255, 255, 255, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--pure-white); text-decoration: none; transition: var(--transition-medium); backdrop-filter: blur(10px);" 
                           onmouseover="this.style.background='var(--primary-light)'; this.style.transform='translateY(-3px)'" 
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.transform='translateY(0)'">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a href="#" style="width: 45px; height: 45px; background: rgba(255, 255, 255, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--pure-white); text-decoration: none; transition: var(--transition-medium); backdrop-filter: blur(10px);" 
                           onmouseover="this.style.background='var(--primary-light)'; this.style.transform='translateY(-3px)'" 
                           onmouseout="this.style.background='rgba(255, 255, 255, 0.1)'; this.style.transform='translateY(0)'">
                            <i class="fab fa-telegram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- الروابط المهمة -->
            <div>
                <h3 style="font-size: 1.2rem; margin-bottom: 1.5rem; color: var(--pure-white); position: relative; padding-bottom: 0.5rem;">
                    روابط مهمة
                </h3>
                
                <ul style="list-style: none; display: grid; gap: 0.75rem;">
                    <li><a href="#vision" style="color: rgba(255, 255, 255, 0.8); display: flex; align-items: center; gap: 0.75rem; transition: var(--transition-fast); text-decoration: none; font-size: 1rem;" onmouseover="this.style.color='var(--pure-white)'; this.style.transform='translateX(-5px)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.transform='translateX(0)'">
                        <i class="fas fa-eye" style="color: var(--primary-light);"></i>
                        عن المنصة
                    </a></li>
                    <li><a href="#golden-opportunities" style="color: rgba(255, 255, 255, 0.8); display: flex; align-items: center; gap: 0.75rem; transition: var(--transition-fast); text-decoration: none; font-size: 1rem;" onmouseover="this.style.color='var(--pure-white)'; this.style.transform='translateX(-5px)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.transform='translateX(0)'">
                        <i class="fas fa-gem" style="color: var(--primary-light);"></i>
                        الوظائف المتاحة
                    </a></li>
                    <li><a href="#success-stories" style="color: rgba(255, 255, 255, 0.8); display: flex; align-items: center; gap: 0.75rem; transition: var(--transition-fast); text-decoration: none; font-size: 1rem;" onmouseover="this.style.color='var(--pure-white)'; this.style.transform='translateX(-5px)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.transform='translateX(0)'">
                        <i class="fas fa-trophy" style="color: var(--primary-light);"></i>
                        قصص نجاح
                    </a></li>
                    <li><a href="#journey" style="color: rgba(255, 255, 255, 0.8); display: flex; align-items: center; gap: 0.75rem; transition: var(--transition-fast); text-decoration: none; font-size: 1rem;" onmouseover="this.style.color='var(--pure-white)'; this.style.transform='translateX(-5px)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.transform='translateX(0)'">
                        <i class="fas fa-map" style="color: var(--primary-light);"></i>
                        خطوات الانضمام
                    </a></li>
                    <li><a href="#dashboard" style="color: rgba(255, 255, 255, 0.8); display: flex; align-items: center; gap: 0.75rem; transition: var(--transition-fast); text-decoration: none; font-size: 1rem;" onmouseover="this.style.color='var(--pure-white)'; this.style.transform='translateX(-5px)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.8)'; this.style.transform='translateX(0)'">
                        <i class="fas fa-chart-bar" style="color: var(--primary-light);"></i>
                        مؤشرات التوظيف
                    </a></li>
                </ul>
            </div>
        </div>

            <!-- الفوتر السفلي -->
            <div style="border-top: 2px solid var(--primary-green); padding: 2rem 0; text-align: center; background: rgba(0, 0, 0, 0.2);">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; padding: 0 40px;">
                    <div style="color: rgba(255, 255, 255, 0.8); font-size: 0.95rem;">
                        &copy; 2025 منصة توافق. جميع الحقوق محفوظة
                    </div>
                    <div style="display: flex; gap: 2rem; flex-wrap: wrap;">
                        <a href="#" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; font-size: 0.9rem; transition: var(--transition-fast);" onmouseover="this.style.color='var(--pure-white)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.7)'">سياسة الخصوصية</a>
                        <a href="#" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; font-size: 0.9rem; transition: var(--transition-fast);" onmouseover="this.style.color='var(--pure-white)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.7)'">شروط الاستخدام</a>
                        <a href="#" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; font-size: 0.9rem; transition: var(--transition-fast);" onmouseover="this.style.color='var(--pure-white)'" onmouseout="this.style.color='rgba(255, 255, 255, 0.7)'">إخلاء المسؤولية</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- زر العودة للأعلى -->
    <button id="scrollTopBtn" style="position: fixed; bottom: 2rem; left: 2rem; width: 55px; height: 55px; background: var(--gradient-primary); color: var(--pure-white); border: none; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; cursor: pointer; z-index: 999; box-shadow: var(--shadow-lg); opacity: 0; visibility: hidden; transform: translateY(20px); transition: var(--transition-medium);" 
            onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
            onmouseover="this.style.transform='translateY(0) scale(1.05)'" 
            onmouseout="this.style.transform='translateY(0) scale(1)'">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- الملفات الخارجية -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.8.0/dist/countUp.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('assets/script.js') }}"></script>
</body>
</html>