<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get active jobs and employees
        $activeJobs = Job::where('status', 'active')->get();
        $employees = User::where('role', 'employee')->get();

        if ($activeJobs->isEmpty() || $employees->isEmpty()) {
            return;
        }

        $applications = [
            // Employee 1 - Web Developer applying to tech jobs
            [
                'job_id' => $activeJobs->where('title', 'مطور ويب متقدم')->first()->id,
                'applicant_id' => $employees->where('email', 'employee1@example.com')->first()->id,
                'cover_letter' => 'أنا مطور ويب ذو خبرة 5 سنوات في Laravel و Vue.js. لدي خبرة قوية في تطوير تطبيقات ويب متقدمة وقواعد البيانات. أعتقد أنني مناسب تماماً لهذه الوظيفة وأتطلع للانضمام لفريقكم.',
                'resume_path' => 'resumes/employee1_resume.pdf',
                'status' => 'pending',
                'notes' => 'مؤهل جيد، خبرة مناسبة',
                'applied_at' => Carbon::now()->subDays(2),
            ],
            [
                'job_id' => $activeJobs->where('title', 'مطور فرونت إند')->first()->id,
                'applicant_id' => $employees->where('email', 'employee1@example.com')->first()->id,
                'cover_letter' => 'على الرغم من أنني متخصص في Laravel، لدي أيضاً خبرة في React.js و JavaScript. أعتقد أنني أستطيع التكيف بسرعة مع متطلبات هذه الوظيفة.',
                'resume_path' => 'resumes/employee1_resume.pdf',
                'status' => 'reviewed',
                'notes' => 'مؤهل جزئياً، يحتاج تدريب في React',
                'applied_at' => Carbon::now()->subDays(5),
            ],

            // Employee 2 - Graphic Designer applying to design jobs
            [
                'job_id' => $activeJobs->where('title', 'مصمم جرافيك')->first()->id,
                'applicant_id' => $employees->where('email', 'employee2@example.com')->first()->id,
                'cover_letter' => 'أنا مصممة جرافيك محترفة مع خبرة في التصميم الرقمي. لدي مهارات قوية في Photoshop و Illustrator وأعتقد أنني أستطيع إضافة قيمة كبيرة لفريقكم.',
                'resume_path' => 'resumes/employee2_resume.pdf',
                'status' => 'shortlisted',
                'notes' => 'مؤهلة ممتازة، تصميمات إبداعية',
                'applied_at' => Carbon::now()->subDays(1),
            ],
            [
                'job_id' => $activeJobs->where('title', 'مصمم UI/UX')->first()->id,
                'applicant_id' => $employees->where('email', 'employee2@example.com')->first()->id,
                'cover_letter' => 'لدي خبرة في تصميم واجهات المستخدم وتجربة المستخدم. أعمل مع Figma وأفهم مبادئ التصميم الحديثة.',
                'resume_path' => 'resumes/employee2_resume.pdf',
                'status' => 'pending',
                'notes' => 'مؤهلة جيداً، تحتاج خبرة أكثر في UI/UX',
                'applied_at' => Carbon::now()->subDays(3),
            ],

            // Employee 3 - Financial Analyst applying to finance jobs
            [
                'job_id' => $activeJobs->where('title', 'محلل مالي')->first()->id,
                'applicant_id' => $employees->where('email', 'employee3@example.com')->first()->id,
                'cover_letter' => 'أنا محلل مالي مع خبرة في التحليل المالي وإدارة المخاطر. لدي مهارات قوية في Excel والنمذجة المالية.',
                'resume_path' => 'resumes/employee3_resume.pdf',
                'status' => 'interviewed',
                'notes' => 'مؤهل ممتاز، مقابلة ناجحة',
                'applied_at' => Carbon::now()->subDays(7),
            ],
            [
                'job_id' => $activeJobs->where('title', 'مدير مخاطر')->first()->id,
                'applicant_id' => $employees->where('email', 'employee3@example.com')->first()->id,
                'cover_letter' => 'لدي خبرة في إدارة المخاطر المالية والامتثال. أعتقد أنني مناسب لهذه الوظيفة.',
                'resume_path' => 'resumes/employee3_resume.pdf',
                'status' => 'accepted',
                'notes' => 'مؤهل ممتاز، تم القبول',
                'applied_at' => Carbon::now()->subDays(10),
            ],

            // Employee 4 - Digital Marketing Specialist applying to marketing jobs
            [
                'job_id' => $activeJobs->where('title', 'متخصص تسويق رقمي')->first()->id,
                'applicant_id' => $employees->where('email', 'employee4@example.com')->first()->id,
                'cover_letter' => 'أنا متخصصة في التسويق الرقمي مع خبرة في إدارة الحملات الإعلانية وتحسين المبيعات. لدي مهارات قوية في Google Ads و Facebook Ads.',
                'resume_path' => 'resumes/employee4_resume.pdf',
                'status' => 'pending',
                'notes' => 'مؤهلة جيداً، تحتاج مراجعة',
                'applied_at' => Carbon::now()->subDays(1),
            ],
            [
                'job_id' => $activeJobs->where('title', 'مدير وسائل التواصل الاجتماعي')->first()->id,
                'applicant_id' => $employees->where('email', 'employee4@example.com')->first()->id,
                'cover_letter' => 'لدي خبرة في إدارة وسائل التواصل الاجتماعي وإنشاء محتوى جذاب. أعرف كيفية بناء مجتمع قوي وتحليل الأداء.',
                'resume_path' => 'resumes/employee4_resume.pdf',
                'status' => 'shortlisted',
                'notes' => 'مؤهلة ممتازة، محتوى إبداعي',
                'applied_at' => Carbon::now()->subDays(4),
            ],

            // Employee 5 - Mobile Developer applying to tech jobs
            [
                'job_id' => $activeJobs->where('title', 'مطور ويب متقدم')->first()->id,
                'applicant_id' => $employees->where('email', 'employee5@example.com')->first()->id,
                'cover_letter' => 'أنا مهندس برمجيات متخصص في تطوير تطبيقات الموبايل، لكن لدي أيضاً خبرة في تطوير الويب. أعتقد أنني أستطيع التكيف مع متطلبات هذه الوظيفة.',
                'resume_path' => 'resumes/employee5_resume.pdf',
                'status' => 'reviewed',
                'notes' => 'مؤهل جزئياً، خبرة في الموبايل',
                'applied_at' => Carbon::now()->subDays(6),
            ],

            // Employee 6 - HR Trainer applying to consulting jobs
            [
                'job_id' => $activeJobs->where('title', 'مستشار إداري')->first()->id,
                'applicant_id' => $employees->where('email', 'employee6@example.com')->first()->id,
                'cover_letter' => 'أنا مدربة موارد بشرية مع خبرة في تطوير المهارات والقيادة. لدي مهارات قوية في التواصل وبناء الفرق.',
                'resume_path' => 'resumes/employee6_resume.pdf',
                'status' => 'pending',
                'notes' => 'مؤهلة جيداً، خبرة في التدريب',
                'applied_at' => Carbon::now()->subDays(2),
            ],

            // Employee 7 - Backend Developer applying to tech jobs
            [
                'job_id' => $activeJobs->where('title', 'مهندس DevOps')->first()->id,
                'applicant_id' => $employees->where('email', 'employee7@example.com')->first()->id,
                'cover_letter' => 'أنا مطور باك إند متخصص في قواعد البيانات والـ APIs. لدي خبرة في Docker و PostgreSQL وأعتقد أنني مناسب لهذه الوظيفة.',
                'resume_path' => 'resumes/employee7_resume.pdf',
                'status' => 'shortlisted',
                'notes' => 'مؤهل جيد، خبرة في قواعد البيانات',
                'applied_at' => Carbon::now()->subDays(3),
            ],

            // Employee 8 - Translator applying to various jobs
            [
                'job_id' => $activeJobs->where('title', 'محلل أعمال')->first()->id,
                'applicant_id' => $employees->where('email', 'employee8@example.com')->first()->id,
                'cover_letter' => 'أنا مترجمة محترفة مع خبرة في الترجمة القانونية والتقنية. لدي مهارات قوية في التحليل والتوثيق.',
                'resume_path' => 'resumes/employee8_resume.pdf',
                'status' => 'pending',
                'notes' => 'مؤهلة جزئياً، خبرة في الترجمة',
                'applied_at' => Carbon::now()->subDays(1),
            ],

            // Some rejected applications
            [
                'job_id' => $activeJobs->where('title', 'مطور ويب متقدم')->first()->id,
                'applicant_id' => $employees->where('email', 'employee8@example.com')->first()->id,
                'cover_letter' => 'أنا مترجمة وأعتقد أنني أستطيع تعلم البرمجة بسرعة.',
                'resume_path' => 'resumes/employee8_resume.pdf',
                'status' => 'rejected',
                'notes' => 'غير مؤهلة، خبرة في الترجمة فقط',
                'applied_at' => Carbon::now()->subDays(8),
            ],

            // Some more applications for variety
            [
                'job_id' => $activeJobs->where('title', 'مصمم UI/UX')->first()->id,
                'applicant_id' => $employees->where('email', 'employee1@example.com')->first()->id,
                'cover_letter' => 'أنا مطور ويب مع اهتمام في تصميم واجهات المستخدم. أعتقد أنني أستطيع الجمع بين التطوير والتصميم.',
                'resume_path' => 'resumes/employee1_resume.pdf',
                'status' => 'pending',
                'notes' => 'مؤهل جزئياً، يحتاج تدريب في التصميم',
                'applied_at' => Carbon::now()->subDays(2),
            ],
            [
                'job_id' => $activeJobs->where('title', 'مدير وسائل التواصل الاجتماعي')->first()->id,
                'applicant_id' => $employees->where('email', 'employee2@example.com')->first()->id,
                'cover_letter' => 'أنا مصممة جرافيك مع اهتمام في وسائل التواصل الاجتماعي. أعتقد أنني أستطيع إنشاء محتوى بصري جذاب.',
                'resume_path' => 'resumes/employee2_resume.pdf',
                'status' => 'reviewed',
                'notes' => 'مؤهلة جزئياً، تصميم جيد',
                'applied_at' => Carbon::now()->subDays(5),
            ],
        ];

        foreach ($applications as $application) {
            // Check if application already exists by job and applicant
            if (!Application::where('job_id', $application['job_id'])->where('applicant_id', $application['applicant_id'])->exists()) {
                Application::create($application);
            }
        }
    }
}
