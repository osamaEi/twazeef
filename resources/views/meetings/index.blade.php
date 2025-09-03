<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الاجتماعات | شركة توافق للتوظيف</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/neo-sans-arabic" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Neo Sans Arabic', sans-serif; background: #f8f9fa; }
        .container { max-width: 1200px; margin: 0 auto; padding: 2rem; }
        .page-header { text-align: center; margin-bottom: 3rem; }
        .page-title { font-size: 2.5rem; font-weight: 700; color: #003c6d; margin-bottom: 0.5rem; }
        .page-subtitle { color: #757575; font-size: 1.1rem; }
        
        .meetings-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .meetings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 2rem;
            border-bottom: 1px solid #e8eff5;
            background: #f8f9fa;
        }

        .meetings-actions {
            display: flex;
            gap: 1rem;
        }

        .meetings-filters {
            display: flex;
            gap: 1rem;
        }

        .filter-select {
            padding: 0.75rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 0.9rem;
            background: white;
            cursor: pointer;
        }

        .meetings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            padding: 2rem;
        }

        .meeting-card {
            background: white;
            border: 1px solid #e8eff5;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .meeting-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .meeting-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 1.5rem 1rem;
        }

        .meeting-platform {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .meeting-platform.zoom {
            background: linear-gradient(135deg, #2d8cff, #1a73e8);
        }

        .meeting-platform.teams {
            background: linear-gradient(135deg, #464eb8, #6264a7);
        }

        .meeting-platform.meet {
            background: linear-gradient(135deg, #34a853, #0f9d58);
        }

        .meeting-platform.in_person {
            background: linear-gradient(135deg, #9c27b0, #7b1fa2);
        }

        .meeting-status {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .meeting-status.scheduled {
            background: #e3f2fd;
            color: #1976d2;
        }

        .meeting-status.in_progress {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .meeting-status.completed {
            background: #f3e5f5;
            color: #7b1fa2;
        }

        .meeting-status.cancelled {
            background: #ffebee;
            color: #c62828;
        }

        .meeting-content {
            padding: 0 1.5rem 1.5rem;
        }

        .meeting-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .meeting-description {
            color: #757575;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .meeting-details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .meeting-detail {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #757575;
        }

        .meeting-detail i {
            width: 16px;
            color: #003c6d;
        }

        .meeting-actions {
            display: flex;
            gap: 0.5rem;
            padding: 1rem 1.5rem;
            border-top: 1px solid #f0f0f0;
            background: #f8f9fa;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            flex: 1;
            justify-content: center;
        }

        .btn-primary {
            background: #003c6d;
            color: white;
        }

        .btn-primary:hover {
            background: #005085;
        }

        .btn-outline {
            background: white;
            color: #003c6d;
            border: 1px solid #003c6d;
        }

        .btn-outline:hover {
            background: #003c6d;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">الاجتماعات</h1>
            <p class="page-subtitle">إدارة الاجتماعات والمقابلات</p>
        </div>

        <div class="meetings-container">
            <div class="meetings-header">
                <div class="meetings-actions">
                    <button class="btn btn-primary" onclick="showCreateMeetingModal()">
                        <i class="fas fa-plus"></i>
                        إنشاء اجتماع جديد
                    </button>
                </div>
                
                <div class="meetings-filters">
                    <select class="filter-select" onchange="filterMeetings(this.value)">
                        <option value="all">جميع الاجتماعات</option>
                        <option value="scheduled">مجدولة</option>
                        <option value="in_progress">جارية</option>
                        <option value="completed">مكتملة</option>
                        <option value="cancelled">ملغية</option>
                    </select>
                </div>
            </div>

            <div class="meetings-grid" id="meetingsGrid">
                <!-- Sample meetings -->
                <div class="meeting-card">
                    <div class="meeting-header">
                        <div class="meeting-platform zoom">
                            <i class="fas fa-video"></i>
                        </div>
                        <div class="meeting-status scheduled">مجدول</div>
                    </div>
                    <div class="meeting-content">
                        <h3 class="meeting-title">مقابلة مع محمد عبدالله</h3>
                        <p class="meeting-description">مقابلة لوظيفة مطور تطبيقات موبايل</p>
                        <div class="meeting-details">
                            <div class="meeting-detail">
                                <i class="fas fa-calendar"></i>
                                <span>23 أغسطس 2025</span>
                            </div>
                            <div class="meeting-detail">
                                <i class="fas fa-clock"></i>
                                <span>2:00 - 3:00 مساءً</span>
                            </div>
                            <div class="meeting-detail">
                                <i class="fas fa-users"></i>
                                <span>2 مشاركين</span>
                            </div>
                        </div>
                    </div>
                    <div class="meeting-actions">
                        <button class="btn btn-outline" onclick="joinMeeting(1)">
                            <i class="fas fa-video"></i>
                            انضمام
                        </button>
                        <button class="btn btn-outline" onclick="editMeeting(1)">
                            <i class="fas fa-edit"></i>
                            تعديل
                        </button>
                    </div>
                </div>

                <div class="meeting-card">
                    <div class="meeting-header">
                        <div class="meeting-platform teams">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="meeting-status in_progress">جاري</div>
                    </div>
                    <div class="meeting-content">
                        <h3 class="meeting-title">اجتماع فريق الموارد البشرية</h3>
                        <p class="meeting-description">مراجعة استراتيجية التوظيف</p>
                        <div class="meeting-details">
                            <div class="meeting-detail">
                                <i class="fas fa-calendar"></i>
                                <span>23 أغسطس 2025</span>
                            </div>
                            <div class="meeting-detail">
                                <i class="fas fa-clock"></i>
                                <span>4:30 - 5:30 مساءً</span>
                            </div>
                            <div class="meeting-detail">
                                <i class="fas fa-users"></i>
                                <span>5 مشاركين</span>
                            </div>
                        </div>
                    </div>
                    <div class="meeting-actions">
                        <button class="btn btn-primary" onclick="joinMeeting(2)">
                            <i class="fas fa-video"></i>
                            انضمام
                        </button>
                        <button class="btn btn-outline" onclick="endMeeting(2)">
                            <i class="fas fa-stop"></i>
                            إنهاء
                        </button>
                    </div>
                </div>

                <div class="meeting-card">
                    <div class="meeting-header">
                        <div class="meeting-platform meet">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="meeting-status completed">مكتمل</div>
                    </div>
                    <div class="meeting-content">
                        <h3 class="meeting-title">مقابلة مع فاطمة أحمد</h3>
                        <p class="meeting-description">مقابلة لوظيفة مديرة تسويق</p>
                        <div class="meeting-details">
                            <div class="meeting-detail">
                                <i class="fas fa-calendar"></i>
                                <span>22 أغسطس 2025</span>
                            </div>
                            <div class="meeting-detail">
                                <i class="fas fa-clock"></i>
                                <span>10:00 - 11:00 صباحاً</span>
                            </div>
                            <div class="meeting-detail">
                                <i class="fas fa-users"></i>
                                <span>2 مشاركين</span>
                            </div>
                        </div>
                    </div>
                    <div class="meeting-actions">
                        <button class="btn btn-outline" onclick="viewRecording(3)">
                            <i class="fas fa-play"></i>
                            عرض التسجيل
                        </button>
                        <button class="btn btn-outline" onclick="viewNotes(3)">
                            <i class="fas fa-sticky-note"></i>
                            الملاحظات
                        </button>
                    </div>
                </div>

                <div class="meeting-card">
                    <div class="meeting-header">
                        <div class="meeting-platform in_person">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="meeting-status scheduled">مجدول</div>
                    </div>
                    <div class="meeting-content">
                        <h3 class="meeting-title">اجتماع شخصي مع العميل</h3>
                        <p class="meeting-description">مناقشة متطلبات المشروع الجديد</p>
                        <div class="meeting-details">
                            <div class="meeting-detail">
                                <i class="fas fa-calendar"></i>
                                <span>25 أغسطس 2025</span>
                            </div>
                            <div class="meeting-detail">
                                <i class="fas fa-clock"></i>
                                <span>11:00 - 12:00 صباحاً</span>
                            </div>
                            <div class="meeting-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>مكتب الشركة - الطابق الثالث</span>
                            </div>
                        </div>
                    </div>
                    <div class="meeting-actions">
                        <button class="btn btn-outline" onclick="viewLocation(4)">
                            <i class="fas fa-map"></i>
                            الموقع
                        </button>
                        <button class="btn btn-outline" onclick="editMeeting(4)">
                            <i class="fas fa-edit"></i>
                            تعديل
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showCreateMeetingModal() {
            alert('سيتم إضافة نموذج إنشاء اجتماع هنا');
        }

        function filterMeetings(status) {
            console.log('Filtering meetings by:', status);
        }

        function joinMeeting(meetingId) {
            alert('سيتم الانضمام للاجتماع رقم: ' + meetingId);
        }

        function editMeeting(meetingId) {
            alert('سيتم تعديل الاجتماع رقم: ' + meetingId);
        }

        function endMeeting(meetingId) {
            alert('سيتم إنهاء الاجتماع رقم: ' + meetingId);
        }

        function viewRecording(meetingId) {
            alert('سيتم عرض تسجيل الاجتماع رقم: ' + meetingId);
        }

        function viewNotes(meetingId) {
            alert('سيتم عرض ملاحظات الاجتماع رقم: ' + meetingId);
        }

        function viewLocation(meetingId) {
            alert('سيتم عرض موقع الاجتماع رقم: ' + meetingId);
        }
    </script>
</body>
</html>