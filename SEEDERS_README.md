# Dashboard Seeders Guide

This guide explains how to use the seeders to populate both the company and employee dashboards with sample data.

## 🚀 Quick Start

### 1. Run the Seeders
```bash
php artisan db:seed
```

This will create:
- 1 Admin user
- 5 Company users
- 8 Employee users
- 15 Jobs (13 active, 1 paused, 1 closed)
- 25 Applications with various statuses

### 2. Login Credentials

#### Admin Dashboard
- **Email:** admin@example.com
- **Password:** password
- **Route:** `/admin`

#### Company Dashboards
- **Company 1:** company1@example.com / password
- **Company 2:** company2@example.com / password
- **Company 3:** company3@example.com / password
- **Company 4:** company4@example.com / password
- **Company 5:** company5@example.com / password

#### Employee Dashboards
- **Employee 1:** employee1@example.com / password
- **Employee 2:** employee2@example.com / password
- **Employee 3:** employee3@example.com / password
- **Employee 4:** employee4@example.com / password
- **Employee 5:** employee5@example.com / password
- **Employee 6:** employee6@example.com / password
- **Employee 7:** employee7@example.com / password
- **Employee 8:** employee8@example.com / password

## 🏢 Company Dashboard Data

### Company 1: شركة التقنية المتقدمة
- **Jobs:** 4 (3 active, 1 paused)
  - مطور ويب متقدم
  - مطور فرونت إند
  - مهندس DevOps
  - مطور باك إند (معلق)
- **Applications:** 8 applications from different employees

### Company 2: شركة الخدمات المالية
- **Jobs:** 2 active
  - محلل مالي
  - مدير مخاطر
- **Applications:** 3 applications

### Company 3: شركة التسويق الرقمي
- **Jobs:** 2 active
  - متخصص تسويق رقمي
  - مدير وسائل التواصل الاجتماعي
- **Applications:** 4 applications

### Company 4: شركة التصميم والإبداع
- **Jobs:** 2 active
  - مصمم جرافيك
  - مصمم UI/UX
- **Applications:** 4 applications

### Company 5: شركة الاستشارات الإدارية
- **Jobs:** 2 active
  - مستشار إداري
  - محلل أعمال
- **Applications:** 2 applications

## 👥 Employee Dashboard Data

### Employee 1: أحمد محمد علي (Web Developer)
- **Skills:** PHP, Laravel, JavaScript, Vue.js, MySQL
- **Applications:** 3 applications
  - مطور ويب متقدم (pending)
  - مطور فرونت إند (reviewed)
  - مصمم UI/UX (pending)

### Employee 2: فاطمة أحمد حسن (Graphic Designer)
- **Skills:** Photoshop, Illustrator, Figma, UI/UX Design
- **Applications:** 3 applications
  - مصمم جرافيك (shortlisted)
  - مصمم UI/UX (pending)
  - مدير وسائل التواصل الاجتماعي (reviewed)

### Employee 3: محمد عبدالله سالم (Financial Analyst)
- **Skills:** Financial Analysis, Excel, Risk Management, Accounting
- **Applications:** 2 applications
  - محلل مالي (interviewed)
  - مدير مخاطر (accepted)

### Employee 4: سارة خالد أحمد (Digital Marketing)
- **Skills:** Digital Marketing, Social Media, SEO, Content Creation
- **Applications:** 2 applications
  - متخصص تسويق رقمي (pending)
  - مدير وسائل التواصل الاجتماعي (shortlisted)

### Employee 5: علي حسن محمد (Mobile Developer)
- **Skills:** React Native, Flutter, Android, iOS, Firebase
- **Applications:** 1 application
  - مطور ويب متقدم (reviewed)

### Employee 6: نورا عبدالرحمن (HR Trainer)
- **Skills:** HR Training, Leadership, Communication, Team Building
- **Applications:** 1 application
  - مستشار إداري (pending)

### Employee 7: خالد سعد عبدالله (Backend Developer)
- **Skills:** Python, Django, PostgreSQL, Docker, AWS
- **Applications:** 1 application
  - مهندس DevOps (shortlisted)

### Employee 8: ريم محمد علي (Translator)
- **Skills:** Arabic-English, Legal Translation, Technical Translation
- **Applications:** 2 applications
  - محلل أعمال (pending)
  - مطور ويب متقدم (rejected)

## 📊 Application Statuses

The seeders create applications with various statuses to show different dashboard states:

- **Pending (معلق):** 8 applications
- **Reviewed (تم المراجعة):** 4 applications
- **Shortlisted (في القائمة المختصرة):** 4 applications
- **Interviewed (تمت المقابلة):** 1 application
- **Accepted (مقبول):** 1 application
- **Rejected (مرفوض):** 1 application

## 🔄 Resetting and Re-seeding

If you want to start fresh:

```bash
# Reset the database
php artisan migrate:fresh

# Run seeders again
php artisan db:seed
```

## 🎯 Testing Different Scenarios

### Test Company Dashboard
1. Login as any company user (e.g., company1@example.com)
2. Navigate to `/dashboard`
3. View statistics, jobs, and applications
4. Test different job statuses (active, paused, closed)

### Test Employee Dashboard
1. Login as any employee user (e.g., employee1@example.com)
2. Navigate to `/dashboard`
3. View application statistics
4. Browse available jobs
5. See application statuses

### Test Admin Dashboard
1. Login as admin (admin@example.com)
2. Navigate to `/admin`
3. View system-wide statistics
4. Manage users, companies, and jobs

## 📝 Customizing Seed Data

You can modify the seeders to:
- Add more companies/employees
- Change job descriptions and requirements
- Modify application statuses
- Add different skills and experience levels
- Change salary ranges and locations

## 🚨 Important Notes

- All users have the password: `password`
- Jobs are set to expire at different dates (1-3 months from now)
- Some jobs are paused/closed to show different states
- Applications have realistic cover letters in Arabic
- Skills are stored as arrays in the database
- All data is in Arabic to match the application language
