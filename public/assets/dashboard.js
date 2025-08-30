/**
 * شركة توافق - لوحة إدارة التوظيف
 * نظام متطور لإدارة الوظائف والموارد البشرية - الإصدار 6.0
 */

document.addEventListener('DOMContentLoaded', function () {
    console.log('🚀 تم تحميل لوحة إدارة التوظيف لشركة توافق بنجاح');

    // === إدارة التنقل ===
    const navLinks = document.querySelectorAll('.nav-link');
    const sidebar = document.querySelector('.sidebar');

    // تفعيل الروابط
    navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            // إزالة الفئة النشطة من جميع الروابط
            navLinks.forEach(l => l.classList.remove('active'));

            // إضافة الفئة النشطة للرابط المختار
            this.classList.add('active');

            console.log('تم التنقل إلى:', this.textContent.trim());

            // السماح للرابط بالعمل بشكل طبيعي
            // لا نستخدم preventDefault() هنا
        });
    });

    // === الأنيميشن عند التحميل ===
    const animatedElements = document.querySelectorAll('.animate-slide-in, .animate-fade-in');

    function startAnimations() {
        animatedElements.forEach((element, index) => {
            setTimeout(() => {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * 100);
        });
    }

    // تشغيل الأنيميشن
    setTimeout(startAnimations, 200);

    // === إدارة البحث المتقدم ===
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('focus', function () {
            this.parentElement.style.transform = 'scale(1.02)';
        });

        searchInput.addEventListener('blur', function () {
            this.parentElement.style.transform = 'scale(1)';
        });

        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase();
            if (query.length > 2) {
                console.log('البحث عن:', query);
                // تطبيق البحث المباشر
                performLiveSearch(query);
            }
        });
    }

    // وظيفة البحث المباشر
    function performLiveSearch(query) {
        const searchableElements = document.querySelectorAll('.company-item, .project-item, .opportunity-card');
        searchableElements.forEach(element => {
            const text = element.textContent.toLowerCase();
            if (text.includes(query)) {
                element.style.display = '';
                element.style.background = 'var(--primary-lightest)';
            } else {
                element.style.display = 'none';
            }
        });
    }

    // === إدارة الأزرار التفاعلية ===
    const opportunityButtons = document.querySelectorAll('.opportunity-button');
    opportunityButtons.forEach(button => {
        button.addEventListener('click', function () {
            const originalText = this.innerHTML;

            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التحميل...';
            this.disabled = true;

            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-check"></i> تم بنجاح';
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 1500);
            }, 2000);
        });
    });

    // === إدارة بطاقات المرشحين ===
    const companyItems = document.querySelectorAll('.company-item');
    companyItems.forEach(item => {
        item.addEventListener('click', function () {
            const candidateName = this.querySelector('.company-name').textContent;
            console.log('تم اختيار المرشح:', candidateName);

            // إزالة التحديد من جميع المرشحين
            companyItems.forEach(candidate => {
                candidate.style.background = '';
                candidate.style.borderColor = 'var(--grey-100)';
            });

            // تحديد المرشح الحالي
            this.style.background = 'var(--primary-lightest)';
            this.style.borderColor = 'var(--primary-light)';

            // عرض تفاصيل المرشح
            showCandidateDetails(candidateName);
        });
    });

    // === إدارة الوظائف ===
    const projectItems = document.querySelectorAll('.project-item');
    projectItems.forEach(item => {
        item.addEventListener('click', function () {
            const jobTitle = this.querySelector('.project-name').textContent;
            console.log('تم اختيار الوظيفة:', jobTitle);

            // تأثير بصري
            this.style.boxShadow = 'var(--shadow-lg)';
            setTimeout(() => {
                this.style.boxShadow = '';
            }, 2000);
        });
    });

    // === عدادات الإحصائيات المتحركة ===
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-value, .analytics-value');

        counters.forEach(counter => {
            const target = counter.textContent;
            const isNumber = /^\d+/.test(target);

            if (isNumber) {
                const finalNumber = parseInt(target.replace(/[^\d]/g, ''));
                const suffix = target.replace(/[\d,\.]/g, '');

                let current = 0;
                const increment = finalNumber / 80;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= finalNumber) {
                        current = finalNumber;
                        clearInterval(timer);
                    }

                    if (suffix.includes('K')) {
                        counter.textContent = (current / 1000).toFixed(0) + 'K';
                    } else {
                        counter.textContent = Math.floor(current).toLocaleString('en-SA') + suffix;
                    }
                }, 25);
            }
        });
    }

    // تشغيل عدادات الإحصائيات بعد ثانية
    setTimeout(animateCounters, 1000);

    // === إدارة النماذج المنبثقة ===
    window.showCreateOpportunityModal = function () {
        document.getElementById('createOpportunityModal').classList.add('active');
    };

    window.showProposalDetails = function () {
        document.getElementById('proposalDetailsModal').classList.add('active');
    };

    window.closeModal = function (modalId) {
        document.getElementById(modalId).classList.remove('active');
    };

    // إغلاق النماذج عند النقر خارجها
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', function (e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });
    });

    // === معالجة نموذج إنشاء الوظيفة ===
    const opportunityForm = document.getElementById('opportunityForm');
    if (opportunityForm) {
        opportunityForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري النشر...';
            submitBtn.disabled = true;

            // محاكاة عملية النشر
            setTimeout(() => {
                submitBtn.innerHTML = '<i class="fas fa-check"></i> تم النشر بنجاح';

                setTimeout(() => {
                    closeModal('createOpportunityModal');
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;

                    // إعادة تعيين النموذج
                    opportunityForm.reset();

                    // عرض رسالة نجاح
                    showSuccessMessage('تم نشر الوظيفة بنجاح!');

                }, 1500);
            }, 3000);
        });
    }

    // === إدارة التنبيهات ===
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach((alert, index) => {
        // إضافة زر إغلاق للتنبيهات
        const closeBtn = document.createElement('button');
        closeBtn.innerHTML = '<i class="fas fa-times"></i>';
        closeBtn.className = 'alert-close';
        closeBtn.style.cssText = `
                    position: absolute;
                    top: 0.5rem;
                    left: 0.5rem;
                    background: none;
                    border: none;
                    color: inherit;
                    opacity: 0.7;
                    cursor: pointer;
                    padding: 0.25rem;
                    border-radius: 50%;
                    transition: all 0.2s ease;
                    width: 24px;
                    height: 24px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                `;

        alert.style.position = 'relative';
        alert.appendChild(closeBtn);

        closeBtn.addEventListener('click', function () {
            alert.style.transform = 'translateX(100%)';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 300);
        });

        closeBtn.addEventListener('mouseenter', function () {
            this.style.opacity = '1';
            this.style.background = 'rgba(0,0,0,0.1)';
        });

        closeBtn.addEventListener('mouseleave', function () {
            this.style.opacity = '0.7';
            this.style.background = 'none';
        });
    });

    // === تحديث الوقت والتاريخ ===
    function updateDateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('ar-SA', {
            hour: '2-digit',
            minute: '2-digit'
        });

        const dateString = now.toLocaleDateString('ar-SA', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        console.log('الوقت الحالي:', timeString, '|', 'التاريخ:', dateString);
    }

    // تحديث الوقت كل دقيقة
    setInterval(updateDateTime, 60000);
    updateDateTime();

    // === محاكاة تحديث البيانات المباشرة ===
    function simulateRealTimeUpdates() {
        // تحديث عدد الإشعارات
        const notificationBadges = document.querySelectorAll('.notification-badge');
        notificationBadges.forEach(badge => {
            const currentCount = parseInt(badge.textContent);
            const randomIncrease = Math.floor(Math.random() * 3);

            if (randomIncrease > 0) {
                const newCount = currentCount + randomIncrease;
                badge.textContent = newCount;
                badge.style.animation = 'pulse 0.8s ease';
                setTimeout(() => {
                    badge.style.animation = '';
                }, 800);
            }
        });

        // تحديث حالة الوظائف
        const jobStatuses = document.querySelectorAll('.project-status');
        jobStatuses.forEach(status => {
            if (Math.random() > 0.7) { // 30% احتمال التحديث
                status.style.animation = 'pulse 1s ease';
                setTimeout(() => {
                    status.style.animation = '';
                }, 1000);
            }
        });
    }

    // تحديث البيانات كل 45 ثانية
    setInterval(simulateRealTimeUpdates, 45000);

    // === إدارة الملف الشخصي ===
    const userProfile = document.querySelector('.user-profile');
    if (userProfile) {
        userProfile.addEventListener('click', function () {
            console.log('فتح قائمة الملف الشخصي');
            showUserProfileMenu();
        });
    }

    function showUserProfileMenu() {
        // إنشاء قائمة منسدلة للملف الشخصي
        const existingDropdown = document.querySelector('.profile-dropdown');
        if (existingDropdown) {
            existingDropdown.remove();
            return;
        }

        const dropdown = document.createElement('div');
        dropdown.className = 'profile-dropdown';
        dropdown.style.cssText = `
                    position: absolute;
                    top: 100%;
                    right: 0;
                    background: var(--pure-white);
                    border-radius: var(--border-radius-md);
                    box-shadow: var(--shadow-lg);
                    border: 1px solid var(--grey-100);
                    min-width: 220px;
                    z-index: 1000;
                    padding: 1rem 0;
                    margin-top: 0.5rem;
                `;

        const options = [
            { icon: 'fas fa-user', text: 'الملف الشخصي', color: 'var(--primary-green)' },
            { icon: 'fas fa-building', text: 'معلومات الشركة', color: 'var(--primary-green)' },
            { icon: 'fas fa-cog', text: 'الإعدادات', color: 'var(--grey-600)' },
            { icon: 'fas fa-bell', text: 'إعدادات الإشعارات', color: 'var(--grey-600)' },
            { icon: 'fas fa-question-circle', text: 'المساعدة والدعم', color: 'var(--grey-600)' },
            { icon: 'fas fa-sign-out-alt', text: 'تسجيل الخروج', color: '#f44336' }
        ];

        options.forEach((option, index) => {
            const item = document.createElement('a');
            item.href = '#';
            item.innerHTML = `<i class="${option.icon}" style="color: ${option.color};"></i> <span>${option.text}</span>`;
            item.style.cssText = `
                        display: flex;
                        align-items: center;
                        gap: 0.75rem;
                        padding: 0.75rem 1.5rem;
                        color: var(--grey-700);
                        text-decoration: none;
                        transition: var(--transition-fast);
                        border-bottom: ${index < options.length - 1 ? '1px solid var(--grey-100)' : 'none'};
                    `;

            item.addEventListener('mouseenter', function () {
                this.style.background = 'var(--primary-lightest)';
                this.style.color = 'var(--primary-green)';
            });

            item.addEventListener('mouseleave', function () {
                this.style.background = '';
                this.style.color = 'var(--grey-700)';
            });

            item.addEventListener('click', function (e) {
                e.preventDefault();
                console.log('تم النقر على:', option.text);
                dropdown.remove();
            });

            dropdown.appendChild(item);
        });

        userProfile.style.position = 'relative';
        userProfile.appendChild(dropdown);

        // إغلاق القائمة عند النقر خارجها
        setTimeout(() => {
            document.addEventListener('click', function closeDropdown(e) {
                if (!userProfile.contains(e.target)) {
                    dropdown.remove();
                    document.removeEventListener('click', closeDropdown);
                }
            });
        }, 100);
    }

    // === إدارة أزرار الإجراءات مع تأثير الموجة ===
    const actionButtons = document.querySelectorAll('.btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            if (!this.disabled && !this.querySelector('.fa-spinner')) {
                createRippleEffect(e, this);
            }
        });
    });

    function createRippleEffect(e, element) {
        const ripple = document.createElement('span');
        const rect = element.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.3);
                    transform: scale(0);
                    animation: ripple 0.6s ease-out;
                    pointer-events: none;
                `;

        element.style.position = 'relative';
        element.style.overflow = 'hidden';
        element.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    // === وظائف مساعدة ===
    function showSuccessMessage(message) {
        const notification = document.createElement('div');
        notification.className = 'alert alert-success';
        notification.innerHTML = `
                    <i class="fas fa-check-circle"></i>
                    <div><strong>${message}</strong></div>
                `;
        notification.style.cssText = `
                    position: fixed;
                    top: 2rem;
                    right: 2rem;
                    z-index: 10000;
                    max-width: 400px;
                    animation: slideIn 0.5s ease-out;
                `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 4000);
    }

    function showCandidateDetails(candidateName) {
        console.log('عرض تفاصيل المرشح:', candidateName);
        // يمكن إضافة نموذج منبثق لعرض تفاصيل المرشح
    }

    // === إضافة أنيميشن الموجة في CSS ===
    const style = document.createElement('style');
    style.textContent = `
                @keyframes ripple {
                    0% {
                        transform: scale(0);
                        opacity: 1;
                    }
                    100% {
                        transform: scale(1);
                        opacity: 0;
                    }
                }
                
                @keyframes slideIn {
                    from {
                        opacity: 0;
                        transform: translateX(100%);
                    }
                    to {
                        opacity: 1;
                        transform: translateX(0);
                    }
                }
            `;
    document.head.appendChild(style);

    // === إدارة الاستجابة للهاتف المحمول ===
    function handleMobileResponsiveness() {
        const isMobile = window.innerWidth <= 768;

        if (isMobile) {
            document.body.classList.add('mobile-view');

            // تخصيصات إضافية للهاتف
            const statsGrid = document.querySelector('.stats-grid');
            if (statsGrid) {
                statsGrid.style.gridTemplateColumns = '1fr';
            }
        } else {
            document.body.classList.remove('mobile-view');
        }
    }

    // استمع لتغيير حجم النافذة
    window.addEventListener('resize', handleMobileResponsiveness);
    handleMobileResponsiveness();

    // === إدارة الأخطاء ===
    window.addEventListener('error', function (e) {
        console.warn('تم اكتشاف خطأ:', e.message);

        const errorNotification = document.createElement('div');
        errorNotification.className = 'alert alert-warning';
        errorNotification.innerHTML = `
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>حدث خطأ غير متوقع. يرجى إعادة تحميل الصفحة أو الاتصال بالدعم الفني.</div>
                `;
        errorNotification.style.cssText = `
                    position: fixed;
                    top: 2rem;
                    right: 2rem;
                    z-index: 10000;
                    max-width: 400px;
                `;

        document.body.appendChild(errorNotification);

        setTimeout(() => {
            errorNotification.remove();
        }, 8000);
    });

    // === تسجيل إحصائيات الأداء ===
    if ('performance' in window && 'timing' in performance) {
        window.addEventListener('load', function () {
            const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
            console.log(`⚡ وقت تحميل لوحة إدارة التوظيف: ${loadTime}ms`);

            if (loadTime > 3000) {
                console.warn('⚠️ تحميل بطيء - يُنصح بتحسين الأداء');
            }
        });
    }

    console.log('✅ تم تهيئة جميع مكونات لوحة إدارة التوظيف بنجاح');
});

// === وظائف عامة خارج DOM ===

// تنسيق الأرقام العربية
function formatArabicNumber(num) {
    return new Intl.NumberFormat('ar-SA').format(num);
}

// تنسيق العملة السعودية
function formatSaudiCurrency(amount) {
    return new Intl.NumberFormat('ar-SA', {
        style: 'currency',
        currency: 'SAR'
    }).format(amount);
}

// تنسيق التاريخ العربي
function formatArabicDate(date) {
    return new Intl.DateTimeFormat('ar-SA', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    }).format(new Date(date));
}

// تصدير البيانات
function exportData(format = 'excel', dataType = 'jobs') {
    console.log(`تصدير ${dataType} بصيغة: ${format}`);

    const exportButton = event.target;
    const originalText = exportButton.textContent;

    exportButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التصدير...';
    exportButton.disabled = true;

    setTimeout(() => {
        exportButton.innerHTML = '<i class="fas fa-check"></i> تم التصدير بنجاح';
        setTimeout(() => {
            exportButton.innerHTML = originalText;
            exportButton.disabled = false;
        }, 2000);
    }, 3000);
}

// إنشاء تقرير مخصص
function generateCustomReport(type, parameters = {}) {
    console.log(`إنشاء تقرير مخصص: ${type}`, parameters);

    const reportData = {
        type: type,
        generated: new Date(),
        jobs: 24,
        candidates: 1847,
        total_salaries: '285K SAR',
        success_rate: '87.5%',
        parameters: parameters
    };

    console.log('بيانات التقرير المخصص:', reportData);
    return reportData;
}

// إعدادات النظام
const systemSettings = {
    theme: 'default',
    language: 'ar',
    notifications: true,
    realTimeUpdates: true,
    autoSave: true
};

// حفظ إعدادات المستخدم
function saveUserSettings(settings) {
    try {
        if (typeof Storage !== 'undefined') {
            localStorage.setItem('tawafuqHRSettings', JSON.stringify({
                ...systemSettings,
                ...settings,
                lastSaved: new Date().toISOString()
            }));
            console.log('تم حفظ الإعدادات بنجاح');
        }
    } catch (e) {
        console.warn('لا يمكن حفظ الإعدادات:', e);
    }
}

// استرداد إعدادات المستخدم
function loadUserSettings() {
    try {
        if (typeof Storage !== 'undefined') {
            const saved = localStorage.getItem('tawafuqHRSettings');
            return saved ? JSON.parse(saved) : systemSettings;
        }
    } catch (e) {
        console.warn('لا يمكن استرداد الإعدادات:', e);
    }
    return systemSettings;
}

// تطبيق الإعدادات المحملة
const currentSettings = loadUserSettings();
console.log('الإعدادات الحالية:', currentSettings);

// === وظائف إضافية للتوظيف ===

// إرسال إشعار للمرشح
function sendNotificationToCandidate(candidateId, message) {
    console.log(`إرسال إشعار للمرشح ${candidateId}:`, message);

    // محاكاة إرسال الإشعار
    setTimeout(() => {
        showSuccessMessage('تم إرسال الإشعار بنجاح');
    }, 1000);
}

// جدولة مقابلة
function scheduleInterview(candidateId, jobId, dateTime) {
    console.log(`جدولة مقابلة - مرشح: ${candidateId}, وظيفة: ${jobId}, موعد: ${dateTime}`);

    const interviewData = {
        candidateId: candidateId,
        jobId: jobId,
        dateTime: dateTime,
        status: 'scheduled',
        createdAt: new Date()
    };

    // محاكاة حفظ بيانات المقابلة
    setTimeout(() => {
        showSuccessMessage('تم جدولة المقابلة بنجاح');
        sendNotificationToCandidate(candidateId, `تم جدولة مقابلة لك في ${dateTime}`);
    }, 1500);

    return interviewData;
}

// تقييم المرشح
function evaluateCandidate(candidateId, evaluation) {
    console.log(`تقييم المرشح ${candidateId}:`, evaluation);

    const evaluationData = {
        candidateId: candidateId,
        rating: evaluation.rating,
        notes: evaluation.notes,
        skills: evaluation.skills,
        recommendation: evaluation.recommendation,
        evaluatedBy: 'أ. سارة أحمد',
        evaluatedAt: new Date()
    };

    // محاكاة حفظ التقييم
    setTimeout(() => {
        showSuccessMessage('تم حفظ تقييم المرشح بنجاح');
    }, 1000);

    return evaluationData;
}

// إنشاء عقد عمل
function createEmploymentContract(candidateId, jobId, terms) {
    console.log(`إنشاء عقد عمل - مرشح: ${candidateId}, وظيفة: ${jobId}`);

    const contractData = {
        candidateId: candidateId,
        jobId: jobId,
        salary: terms.salary,
        startDate: terms.startDate,
        duration: terms.duration,
        benefits: terms.benefits,
        status: 'draft',
        createdAt: new Date()
    };

    // محاكاة إنشاء العقد
    setTimeout(() => {
        showSuccessMessage('تم إنشاء عقد العمل بنجاح');
    }, 2000);

    return contractData;
}

// إحصائيات الأداء
function getPerformanceStats() {
    return {
        totalJobs: 24,
        activeJobs: 18,
        totalApplications: 67,
        acceptedApplications: 12,
        rejectedApplications: 23,
        pendingApplications: 32,
        totalEmployees: 89,
        averageSalary: 8750,
        successRate: 87.5,
        monthlyHires: 12
    };
}

// تحديث إحصائيات الداشبورد
function updateDashboardStats() {
    const stats = getPerformanceStats();

    // تحديث العناصر في الصفحة
    const elements = {
        jobs: document.querySelector('.stat-value'),
        candidates: document.querySelectorAll('.stat-value')[1],
        applications: document.querySelectorAll('.stat-value')[2],
        employees: document.querySelectorAll('.stat-value')[3]
    };

    if (elements.jobs) elements.jobs.textContent = stats.totalJobs;
    if (elements.candidates) elements.candidates.textContent = stats.totalEmployees;
    if (elements.applications) elements.applications.textContent = stats.totalApplications;
    if (elements.employees) elements.employees.textContent = stats.totalEmployees;

    console.log('تم تحديث إحصائيات الداشبورد');
}

// تشغيل تحديث الإحصائيات كل 5 دقائق
setInterval(updateDashboardStats, 300000);

// === إدارة الملفات ===

// رفع ملف السيرة الذاتية
function uploadResume(file, candidateId) {
    console.log(`رفع سيرة ذاتية للمرشح ${candidateId}:`, file.name);

    // محاكاة رفع الملف
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            if (file.size > 5 * 1024 * 1024) { // 5MB
                reject('حجم الملف كبير جداً');
            } else {
                resolve({
                    fileId: Date.now(),
                    fileName: file.name,
                    fileSize: file.size,
                    uploadedAt: new Date(),
                    candidateId: candidateId
                });
            }
        }, 2000);
    });
}

// تحليل السيرة الذاتية باستخدام AI
function analyzeResume(fileId) {
    console.log(`تحليل السيرة الذاتية ${fileId}`);

    // محاكاة تحليل AI
    return new Promise((resolve) => {
        setTimeout(() => {
            resolve({
                skills: ['JavaScript', 'React', 'Node.js', 'MongoDB'],
                experience: '5 سنوات',
                education: 'بكالوريوس هندسة برمجيات',
                languages: ['العربية', 'الإنجليزية'],
                score: 85,
                recommendations: [
                    'مرشح ممتاز لوظائف التطوير',
                    'خبرة جيدة في تقنيات الويب الحديثة',
                    'يُنصح بإجراء مقابلة فنية'
                ]
            });
        }, 3000);
    });
}

// === تصدير البيانات ===

// تصدير قائمة المرشحين
function exportCandidates() {
    const candidates = [
        { name: 'محمد عبدالله', position: 'مطور برمجيات', experience: '5 سنوات', salary: '8000' },
        { name: 'فاطمة أحمد', position: 'مديرة تسويق', experience: '7 سنوات', salary: '12000' },
        { name: 'أحمد سالم', position: 'محاسب قانوني', experience: '8 سنوات', salary: '10000' }
    ];

    console.log('تصدير قائمة المرشحين:', candidates);
    return candidates;
}

// تصدير قائمة الوظائف
function exportJobs() {
    const jobs = [
        { title: 'مطور تطبيقات موبايل', department: 'تطوير التطبيقات', salary: '8500', status: 'نشطة' },
        { title: 'مديرة موارد بشرية', department: 'الموارد البشرية', salary: '12000', status: 'مراجعة' },
        { title: 'محاسب مالي', department: 'المالية', salary: '9000', status: 'نشطة' }
    ];

    console.log('تصدير قائمة الوظائف:', jobs);
    return jobs;
}

console.log('🎉 تم تحميل جميع وظائف شركة توافق للتوظيف بنجاح');
