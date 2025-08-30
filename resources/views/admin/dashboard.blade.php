@extends('dashboard.index')

@section('title', 'لوحة الإدارة')

@section('content')
<div class="dashboard-content">
    <!-- تنبيه ترحيبي -->
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i>
        <div>
            <strong>مرحباً بك في لوحة الإدارة!</strong> يمكنك مراجعة وإدارة جميع جوانب منصة توافق للتوظيف.
        </div>
    </div>

    <!-- الإحصائيات الرئيسية -->
    <div class="stats-grid">
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+12%</span>
                </div>
            </div>
            <div class="stat-value">1,247</div>
            <div class="stat-label">إجمالي المستخدمين</div>
            <div class="stat-description">جميع المستخدمين المسجلين</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+8%</span>
                </div>
            </div>
            <div class="stat-value">89</div>
            <div class="stat-label">الشركات المسجلة</div>
            <div class="stat-description">الشركات والمؤسسات</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-up"></i>
                    <span>+15%</span>
                </div>
            </div>
            <div class="stat-value">342</div>
            <div class="stat-label">الوظائف النشطة</div>
            <div class="stat-description">الوظائف المتاحة حالياً</div>
        </div>
        
        <div class="stat-card animate-slide-in">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-trend">
                    <i class="fas fa-arrow-down"></i>
                    <span>-3%</span>
                </div>
            </div>
            <div class="stat-value">1,089</div>
            <div class="stat-label">طلبات التقديم</div>
            <div class="stat-description">إجمالي الطلبات</div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🚀 تم تحميل لوحة الإدارة بنجاح');
        
            // === تحديث الوقت ===
            updateCurrentTime();
            setInterval(updateCurrentTime, 60000); // تحديث كل دقيقة
        
            // === تشغيل الأنيميشن ===
            startAnimations();
        
            // === إضافة تأثيرات التفاعل ===
            addInteractionEffects();
        });
        
        // === وظائف النظام ===
        function updateCurrentTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('ar-SA', { 
                hour: '2-digit', 
                minute: '2-digit',
                hour12: false 
            });
            document.getElementById('currentTime').textContent = timeString;
        }
        
        function refreshActivities() {
            const button = event.target;
            const originalText = button.innerHTML;
            
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التحديث...';
            button.disabled = true;
            
            setTimeout(() => {
                button.innerHTML = '<i class="fas fa-check"></i> تم التحديث';
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                    showSuccessMessage('تم تحديث النشاطات بنجاح');
                }, 1500);
            }, 2000);
        }
        
        function viewUser(userId) {
            console.log('عرض المستخدم:', userId);
            showSuccessMessage('سيتم توجيهك لصفحة المستخدم');
        }
        
        function viewCompany(companyId) {
            console.log('عرض الشركة:', companyId);
            showSuccessMessage('سيتم توجيهك لصفحة الشركة');
        }
        
        function viewJob(jobId) {
            console.log('عرض الوظيفة:', jobId);
            showSuccessMessage('سيتم توجيهك لصفحة الوظيفة');
        }
        
        function viewApplication(applicationId) {
            console.log('عرض الطلب:', applicationId);
            showSuccessMessage('سيتم توجيهك لصفحة الطلب');
        }
        
        // === الأنيميشن ===
        function startAnimations() {
            const animatedElements = document.querySelectorAll('.animate-slide-in, .animate-fade-in');
            
            animatedElements.forEach((element, index) => {
                setTimeout(() => {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 100);
            });
        }
        
        // === تأثيرات التفاعل ===
        function addInteractionEffects() {
            // تأثيرات البطاقات
            const opportunityCards = document.querySelectorAll('.opportunity-card');
            opportunityCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.15)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
                });
            });
        
            // تأثيرات النشاطات
            const activityItems = document.querySelectorAll('.activity-item');
            activityItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.background = 'var(--primary-lightest)';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.background = '';
                });
            });
        }
        
        // === إضافة أنيميشن الموجة ===
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
        
        // === إضافة CSS للأنيميشن ===
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
            
            .animate-slide-in {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.6s ease-out;
            }
            
            .animate-fade-in {
                opacity: 0;
                transition: opacity 0.8s ease-out;
            }
            
            .opportunity-card {
                transition: all 0.3s ease;
            }
            
            .activity-item {
                transition: all 0.3s ease;
            }
            
            .status-active {
                color: var(--primary-green);
                font-weight: 600;
            }
            
            .system-info-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1rem;
            }
            
            .info-card {
                background: white;
                padding: 1.5rem;
                border-radius: 0.5rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                display: flex;
                align-items: center;
                gap: 1rem;
                transition: all 0.3s ease;
            }
            
            .info-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }
            
            .info-icon {
                width: 3rem;
                height: 3rem;
                border-radius: 50%;
                background: var(--primary-light);
                color: var(--primary-green);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.25rem;
            }
            
            .info-content {
                flex: 1;
            }
            
            .info-title {
                font-size: 0.875rem;
                color: #6b7280;
                margin-bottom: 0.25rem;
            }
            
            .info-value {
                font-size: 1.125rem;
                font-weight: 600;
                color: #1f2937;
                margin: 0;
            }
            
            .opportunity-actions {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                margin-top: 1rem;
            }
            
            .opportunity-button.secondary {
                background: var(--primary-light);
                color: var(--primary-green);
            }
            
            .opportunity-button.secondary:hover {
                background: var(--primary-green);
                color: white;
            }
            
            .activity-actions {
                margin-left: auto;
            }
        `;
        document.head.appendChild(style);
        
        console.log('✅ تم تهيئة جميع مكونات لوحة الإدارة بنجاح');
        </script>
    
</div>

@endsection



