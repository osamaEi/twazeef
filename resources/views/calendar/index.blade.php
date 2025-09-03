<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التقويم | شركة توافق للتوظيف</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/neo-sans-arabic" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Neo Sans Arabic', sans-serif; background: #f8f9fa; }
        .container { max-width: 1200px; margin: 0 auto; padding: 2rem; }
        .page-header { text-align: center; margin-bottom: 3rem; }
        .page-title { font-size: 2.5rem; font-weight: 700; color: #003c6d; margin-bottom: 0.5rem; }
        .page-subtitle { color: #757575; font-size: 1.1rem; }
        
        .calendar-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem;
            border-bottom: 1px solid #e8eff5;
            background: #f8f9fa;
        }

        .calendar-nav {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .calendar-nav-btn {
            width: 40px;
            height: 40px;
            border: none;
            background: #003c6d;
            color: white;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .calendar-nav-btn:hover {
            background: #005085;
            transform: scale(1.1);
        }

        .calendar-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        .calendar-actions {
            display: flex;
            gap: 1rem;
        }

        .calendar-grid {
            padding: 2rem;
        }

        .calendar-month {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }

        .calendar-day-header {
            background: #003c6d;
            color: white;
            padding: 1rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .calendar-day {
            background: white;
            min-height: 120px;
            padding: 0.75rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #f0f0f0;
        }

        .calendar-day:hover {
            background: #f8f9fa;
        }

        .calendar-day.today {
            background: #e8eff5;
            border: 2px solid #003c6d;
        }

        .calendar-day.other-month {
            opacity: 0.3;
            background: #f5f5f5;
        }

        .day-number {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1a1a1a;
        }

        .day-events {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .calendar-event {
            background: #003c6d;
            color: white;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 500;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
        }

        .calendar-event.interview { background: #2196f3; }
        .calendar-event.meeting { background: #4caf50; }
        .calendar-event.deadline { background: #ff9800; }
        .calendar-event.personal { background: #9c27b0; }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: #003c6d;
            color: white;
        }

        .btn-primary:hover {
            background: #005085;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">التقويم</h1>
            <p class="page-subtitle">إدارة المواعيد والأحداث</p>
        </div>

        <div class="calendar-container">
            <div class="calendar-header">
                <div class="calendar-nav">
                    <button class="calendar-nav-btn" onclick="previousMonth()">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <div class="calendar-title" id="calendarTitle">أغسطس 2025</div>
                    <button class="calendar-nav-btn" onclick="nextMonth()">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>
                
                <div class="calendar-actions">
                    <button class="btn btn-primary" onclick="showCreateEventModal()">
                        <i class="fas fa-plus"></i>
                        إضافة حدث
                    </button>
                </div>
            </div>

            <div class="calendar-grid">
                <div class="calendar-month" id="calendarMonth">
                    <!-- Calendar will be generated here -->
                    <div class="calendar-day-header">السبت</div>
                    <div class="calendar-day-header">الأحد</div>
                    <div class="calendar-day-header">الاثنين</div>
                    <div class="calendar-day-header">الثلاثاء</div>
                    <div class="calendar-day-header">الأربعاء</div>
                    <div class="calendar-day-header">الخميس</div>
                    <div class="calendar-day-header">الجمعة</div>
                    
                    <!-- Sample calendar days -->
                    <div class="calendar-day other-month">
                        <div class="day-number">29</div>
                    </div>
                    <div class="calendar-day other-month">
                        <div class="day-number">30</div>
                    </div>
                    <div class="calendar-day other-month">
                        <div class="day-number">31</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">1</div>
                        <div class="day-events">
                            <div class="calendar-event meeting">اجتماع افتتاحي</div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">2</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">3</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">4</div>
                        <div class="day-events">
                            <div class="calendar-event interview">مقابلة أحمد</div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">5</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">6</div>
                        <div class="day-events">
                            <div class="calendar-event meeting">تقييم الأداء</div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">7</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">8</div>
                        <div class="day-events">
                            <div class="calendar-event interview">مقابلة فاطمة</div>
                            <div class="calendar-event meeting">اجتماع فريق</div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">9</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">10</div>
                        <div class="day-events">
                            <div class="calendar-event deadline">موعد نهائي</div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">11</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">12</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">13</div>
                        <div class="day-events">
                            <div class="calendar-event meeting">ورشة تدريبية</div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">14</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">15</div>
                        <div class="day-events">
                            <div class="calendar-event interview">مقابلة عمر</div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">16</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">17</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">18</div>
                        <div class="day-events">
                            <div class="calendar-event meeting">مراجعة شهرية</div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">19</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">20</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">21</div>
                        <div class="day-events">
                            <div class="calendar-event interview">مقابلة ليلى</div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">22</div>
                    </div>
                    <div class="calendar-day today">
                        <div class="day-number">23</div>
                        <div class="day-events">
                            <div class="calendar-event interview">مقابلة محمد</div>
                            <div class="calendar-event meeting">اجتماع فريق</div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">24</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">25</div>
                        <div class="day-events">
                            <div class="calendar-event deadline">تقرير شهري</div>
                        </div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">26</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">27</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">28</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">29</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">30</div>
                    </div>
                    <div class="calendar-day">
                        <div class="day-number">31</div>
                    </div>
                    <div class="calendar-day other-month">
                        <div class="day-number">1</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showCreateEventModal() {
            alert('سيتم إضافة نموذج إنشاء حدث هنا');
        }

        function previousMonth() {
            console.log('Previous month');
        }

        function nextMonth() {
            console.log('Next month');
        }
    </script>
</body>
</html>