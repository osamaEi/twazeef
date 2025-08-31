<footer style="background: var(--primary-darkest); color: var(--pure-white); padding: 80px 0 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 3rem; margin-bottom: 3rem;">
            <!-- قسم المنصة -->
            <div>
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
                    <div>
                        <img src="{{ asset('elaf1.png') }}" width="280" alt="منصة توافق">
                    </div>
                </div>
                <p style="color: rgba(255, 255, 255, 0.8); line-height: 1.7; margin-bottom: 2rem; font-size: 1.05rem;">
                    توافق هي منصة توظيف حديثة تهدف إلى ربط أصحاب العمل بالكفاءات المميزة، وتسهيل الوصول إلى فرص عمل نوعية في مختلف المجالات والقطاعات.
                </p>
                
                <!-- إحصائيات الفوتر -->
                <div style="background: rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: var(--border-radius-md); border: 1px solid rgba(255, 255, 255, 0.1);">
                    <h4 style="color: var(--primary-light); margin-bottom: 1rem; font-size: 1.1rem;">إحصائيات المنصة</h4>
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
                    <h4 style="color: var(--primary-light); margin-bottom: 1rem; font-size: 1rem;">تابعنا على</h4>
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
                    &copy; {{ date('Y') }} منصة توافق. جميع الحقوق محفوظة
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
