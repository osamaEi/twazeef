

document.addEventListener('DOMContentLoaded', function() {

    // تسجيل مكونات GSAP
    gsap.registerPlugin(ScrollTrigger);

    // === إدارة شريط التنقل ===
    const navbar = document.getElementById('navbar');
    const navMenu = document.getElementById('navMenu');
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const navLinks = document.querySelectorAll('.nav-link');
    const scrollTopBtn = document.getElementById('scrollTopBtn');

    // تأثير التمرير على شريط التنقل
    function handleNavbarScroll() {
        const isScrolled = window.scrollY > 100;
        if (navbar) navbar.classList.toggle('scrolled', isScrolled);
        if (scrollTopBtn) {
            if (isScrolled) {
                scrollTopBtn.style.opacity = '1';
                scrollTopBtn.style.visibility = 'visible';
                scrollTopBtn.style.transform = 'translateY(0)';
            } else {
                scrollTopBtn.style.opacity = '0';
                scrollTopBtn.style.visibility = 'hidden';
                scrollTopBtn.style.transform = 'translateY(20px)';
            }
        }
    }

    // استمع لحدث التمرير
    let ticking = false;
    function optimizedScroll() {
        if (!ticking) {
            requestAnimationFrame(() => {
                handleNavbarScroll();
                updateActiveLink();
                ticking = false;
            });
            ticking = true;
        }
    }
    window.addEventListener('scroll', optimizedScroll, { passive: true });

    // قائمة الهاتف المحمول
    if (mobileMenuBtn && navMenu) {
        mobileMenuBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            navMenu.classList.toggle('active');
            const icon = mobileMenuBtn.querySelector('i');
            if (icon) {
                if (navMenu.classList.contains('active')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            }
        });
    }

    // إغلاق القائمة
    function closeMenu() {
        if (navMenu && navMenu.classList.contains('active')) {
            navMenu.classList.remove('active');
            const icon = mobileMenuBtn?.querySelector('i');
            if (icon) {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }
    }

    // إغلاق القائمة عند النقر على رابط أو خارج القائمة
    navLinks.forEach(link => link.addEventListener('click', closeMenu));
    document.addEventListener('click', (e) => {
        if (navMenu && !navMenu.contains(e.target) && !mobileMenuBtn?.contains(e.target)) {
            closeMenu();
        }
    });

    // === تحديث الرابط النشط ===
    const sections = document.querySelectorAll('section[id]');
    function updateActiveLink() {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            if (window.scrollY >= sectionTop - 200 && window.scrollY < sectionTop + sectionHeight - 200) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href')?.substring(1) === current) {
                link.classList.add('active');
            }
        });
    }

    // === الحركات السينمائية ===
    // تأثيرات الظهور للعناصر
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);

    // مراقبة العناصر
    const elementsToObserve = document.querySelectorAll('.metric-card, .opportunity-card, .story-card, .journey-step, .chart-card');
    elementsToObserve.forEach(el => observer.observe(el));

    // === عدادات الأرقام ===
    function initCounters() {
        const counters = document.querySelectorAll('.metric-value[data-target], .summary-value[data-target]');
        counters.forEach(counter => {
            ScrollTrigger.create({
                trigger: counter,
                start: 'top 85%',
                once: true,
                onEnter: () => {
                    const target = +counter.dataset.target;
                    if (typeof CountUp !== 'undefined') {
                        const countUp = new CountUp(counter, target, { 
                            duration: 2.5, 
                            separator: ',', 
                            useEasing: true 
                        });
                        if (!countUp.error) {
                            countUp.start();
                        }
                    } else {
                        // بديل في حالة عدم توفر CountUp
                        let current = 0;
                        const increment = target / 60;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= target) {
                                current = target;
                                clearInterval(timer);
                            }
                            counter.innerHTML = '+' + Math.floor(current).toLocaleString('en-SA');
                        }, 30);
                    }
                }
            });
        });
    }
    initCounters();

    // === نظام التبويبات للرؤية ===
    function initVisionTabs() {
        const visionTabs = document.querySelectorAll('.vision-tab-btn');
        const visionContents = document.querySelectorAll('.vision-tab-content');
        
        visionTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // إزالة النشاط من جميع التبويبات
                visionTabs.forEach(t => t.classList.remove('active'));
                visionContents.forEach(content => content.classList.remove('active'));
                
                // تفعيل التبويب المحدد
                tab.classList.add('active');
                const targetId = tab.dataset.tab;
                const targetContent = document.getElementById(targetId);
                if (targetContent) {
                    targetContent.classList.add('active');
                }
            });
        });
    }
    initVisionTabs();

    // === نظام التبويبات للرحلة ===
    function initJourneyTabs() {
        const journeyTabs = document.querySelectorAll('.journey-tab-btn');
        const journeyContents = document.querySelectorAll('.journey-tab-content');
        
        journeyTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // إزالة النشاط من جميع التبويبات
                journeyTabs.forEach(t => t.classList.remove('active'));
                journeyContents.forEach(content => content.classList.remove('active'));
                
                // تفعيل التبويب المحدد
                tab.classList.add('active');
                const targetId = tab.dataset.tab;
                const targetContent = document.getElementById(targetId);
                if (targetContent) {
                    targetContent.classList.add('active');
                }
            });
        });
    }
    initJourneyTabs();

    // === الرسوم البيانية ===
    function initCharts() {
        if (typeof ApexCharts === 'undefined') {
            console.warn('ApexCharts غير متاح');
            return;
        }

        const chartColors = {
            primary: '#006d46',
            light: '#00855a',
            lighter: '#e8f5f0'
        };

        // رسم نمو التوظيف فقط
        const investmentsChartEl = document.querySelector("#investments-chart");
        if (investmentsChartEl) {
            const investmentsOptions = {
                series: [{
                    name: 'التوظيف (مليار ريال)',
                    data: [85, 142, 178] // يونيو، يوليو، أغسطس
                }],
                chart: {
                    type: 'area',
                    height: 320,
                    fontFamily: 'Neo Sans Arabic, sans-serif',
                    toolbar: { show: false },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3,
                    colors: [chartColors.primary]
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.1,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: { enabled: false },
                xaxis: {
                    categories: ['يونيو 2025', 'يوليو 2025', 'أغسطس 2025'],
                    labels: {
                        style: {
                            colors: '#757575',
                            fontFamily: 'Neo Sans Arabic',
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: 'مليار ريال',
                        style: {
                            color: '#757575',
                            fontFamily: 'Neo Sans Arabic'
                        }
                    },
                    labels: {
                        style: {
                            colors: '#757575',
                            fontFamily: 'Neo Sans Arabic'
                        }
                    }
                },
                colors: [chartColors.primary],
                grid: {
                    borderColor: '#f1f1f1',
                    strokeDashArray: 4
                },
                tooltip: {
                    y: {
                        formatter: (val) => `${val} مليار ريال`
                    }
                }
            };

            const investmentsChart = new ApexCharts(investmentsChartEl, investmentsOptions);
            
            ScrollTrigger.create({
                trigger: investmentsChartEl,
                start: 'top 80%',
                once: true,
                onEnter: () => investmentsChart.render()
            });
        }
    }
    initCharts();

    initPartnersSlider();

    // === وظائف الأزرار ===
    window.downloadReport = function() {
        const button = event.target.closest('.btn');
        const originalText = button.innerHTML;
        
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التحميل...';
        button.disabled = true;
        
        setTimeout(() => {
            button.innerHTML = '<i class="fas fa-check"></i> تم التحميل بنجاح';
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 2000);
        }, 3000);
    };

    window.viewLiveData = function() {
        const button = event.target.closest('.btn');
        const originalText = button.innerHTML;
        
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التحميل...';
        button.disabled = true;
        
        setTimeout(() => {
            button.innerHTML = '<i class="fas fa-external-link-alt"></i> فتح في نافذة جديدة';
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 2000);
        }, 2000);
    };

    // === التحقق من أداء الموقع ===
    window.addEventListener('load', function() {
        console.log('🎯 تم تحميل منصة توافق بنجاح - الإصدار 4.0');
        
        // إحصائيات الأداء
        if ('performance' in window && 'timing' in performance) {
            const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
            console.log(`⚡ وقت التحميل: ${loadTime}ms`);
        }
    });

    // معالجة الأخطاء
    window.addEventListener('error', function(e) {
        console.warn('تحذير في تحميل المكونات:', e.message);
    });

    // تفعيل التأثيرات المتقدمة
    setTimeout(() => {
        document.body.classList.add('loaded');
    }, 100);
});
