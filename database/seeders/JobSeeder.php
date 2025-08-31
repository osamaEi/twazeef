<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;
use Carbon\Carbon;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get company users
        $companies = User::where('role', 'company')->get();

        if ($companies->isEmpty()) {
            return;
        }

        $jobs = [
            // Company 1 - Tech Company
            [
                'company_id' => $companies[0]->id,
                'title' => 'مطور ويب متقدم',
                'description' => 'نبحث عن مطور ويب ذو خبرة في Laravel و Vue.js لتطوير تطبيقات ويب متقدمة. يجب أن يكون لديه خبرة في قواعد البيانات والـ APIs.',
                'location' => 'الرياض',
                'type' => 'full-time',
                'experience_level' => 'mid',
                'salary_min' => 8000,
                'salary_max' => 15000,
                'salary_currency' => 'SAR',
                'skills' => ['PHP', 'Laravel', 'Vue.js', 'MySQL', 'REST APIs'],
                'benefits' => ['تأمين صحي', 'إجازة سنوية', 'تدريب مستمر'],
                'status' => 'active',
                'expires_at' => Carbon::now()->addMonths(2),
            ],
            [
                'company_id' => $companies[0]->id,
                'title' => 'مطور فرونت إند',
                'description' => 'نحتاج مطور فرونت إند متخصص في React.js و TypeScript لتطوير واجهات مستخدم حديثة وجذابة.',
                'location' => 'جدة',
                'type' => 'full-time',
                'experience_level' => 'entry',
                'salary_min' => 6000,
                'salary_max' => 10000,
                'salary_currency' => 'SAR',
                'skills' => ['React.js', 'TypeScript', 'CSS3', 'HTML5', 'JavaScript'],
                'benefits' => ['تأمين صحي', 'عمل عن بعد', 'مكتب مرن'],
                'status' => 'active',
                'expires_at' => Carbon::now()->addMonths(1),
            ],
            [
                'company_id' => $companies[0]->id,
                'title' => 'مهندس DevOps',
                'description' => 'نبحث عن مهندس DevOps لإدارة البنية التحتية وتطوير خطوط الإنتاج الآلية.',
                'location' => 'الدمام',
                'type' => 'full-time',
                'experience_level' => 'senior',
                'salary_min' => 12000,
                'salary_max' => 20000,
                'salary_currency' => 'SAR',
                'skills' => ['Docker', 'Kubernetes', 'AWS', 'CI/CD', 'Linux'],
                'benefits' => ['تأمين صحي', 'بدل سكن', 'بدل نقل'],
                'status' => 'active',
                'expires_at' => Carbon::now()->addMonths(3),
            ],

            // Company 2 - Finance Company
            [
                'company_id' => $companies[1]->id,
                'title' => 'محلل مالي',
                'description' => 'نحتاج محلل مالي لتحليل البيانات المالية وإعداد التقارير والتنبؤات المالية.',
                'location' => 'الرياض',
                'type' => 'full-time',
                'experience_level' => 'mid',
                'salary_min' => 7000,
                'salary_max' => 12000,
                'salary_currency' => 'SAR',
                'skills' => ['Financial Analysis', 'Excel', 'Financial Modeling', 'Accounting'],
                'benefits' => ['تأمين صحي', 'بدل تعليم', 'مكافآت سنوية'],
                'status' => 'active',
                'expires_at' => Carbon::now()->addMonths(2),
            ],
            [
                'company_id' => $companies[1]->id,
                'title' => 'مدير مخاطر',
                'description' => 'نبحث عن مدير مخاطر لتقييم وإدارة المخاطر المالية والعملياتية للشركة.',
                'location' => 'جدة',
                'type' => 'full-time',
                'experience_level' => 'senior',
                'salary_min' => 10000,
                'salary_max' => 18000,
                'salary_currency' => 'SAR',
                'skills' => ['Risk Management', 'Financial Risk', 'Compliance', 'Audit'],
                'benefits' => ['تأمين صحي', 'بدل سكن', 'بدل نقل'],
                'status' => 'active',
                'expires_at' => Carbon::now()->addMonths(2),
            ],

            // Company 3 - Marketing Company
            [
                'company_id' => $companies[2]->id,
                'title' => 'متخصص تسويق رقمي',
                'description' => 'نحتاج متخصص في التسويق الرقمي لإدارة الحملات الإعلانية وتحسين المبيعات.',
                'location' => 'الرياض',
                'type' => 'full-time',
                'experience_level' => 'entry',
                'salary_min' => 5000,
                'salary_max' => 9000,
                'salary_currency' => 'SAR',
                'skills' => ['Digital Marketing', 'Google Ads', 'Facebook Ads', 'SEO', 'Analytics'],
                'benefits' => ['تأمين صحي', 'عمولة على المبيعات', 'تدريب مستمر'],
                'status' => 'active',
                'expires_at' => Carbon::now()->addMonths(1),
            ],
            [
                'company_id' => $companies[2]->id,
                'title' => 'مدير وسائل التواصل الاجتماعي',
                'description' => 'نبحث عن مدير لوسائل التواصل الاجتماعي لإنشاء محتوى جذاب وإدارة الحسابات.',
                'location' => 'جدة',
                'type' => 'دوام كامل',
                'experience_level' => 'متوسط',
                'salary_min' => 6000,
                'salary_max' => 11000,
                'salary_currency' => 'SAR',
                'skills' => ['Social Media', 'Content Creation', 'Community Management', 'Analytics'],
                'benefits' => ['تأمين صحي', 'عمل عن بعد', 'مكتب مرن'],
                'status' => 'active',
                'expires_at' => Carbon::now()->addMonths(2),
            ],

            // Company 4 - Design Company
            [
                'company_id' => $companies[3]->id,
                'title' => 'مصمم جرافيك',
                'description' => 'نحتاج مصمم جرافيك موهوب لإنشاء تصاميم إبداعية للمشاريع المختلفة.',
                'location' => 'الدمام',
                'type' => 'دوام كامل',
                'experience_level' => 'مبتدئ - متوسط',
                'salary_min' => 5000,
                'salary_max' => 9000,
                'salary_currency' => 'SAR',
                'skills' => ['Photoshop', 'Illustrator', 'InDesign', 'Typography', 'Color Theory'],
                'benefits' => ['تأمين صحي', 'بدل مواد تصميم', 'تدريب مستمر'],
                'status' => 'active',
                'expires_at' => Carbon::now()->addMonths(1),
            ],
            [
                'company_id' => $companies[3]->id,
                'title' => 'مصمم UI/UX',
                'description' => 'نبحث عن مصمم UI/UX لتصميم واجهات مستخدم سلسة وجذابة.',
                'location' => 'الرياض',
                'type' => 'دوام كامل',
                'experience_level' => 'متوسط - متقدم',
                'salary_min' => 7000,
                'salary_max' => 13000,
                'salary_currency' => 'SAR',
                'skills' => ['Figma', 'Sketch', 'Prototyping', 'User Research', 'Wireframing'],
                'benefits' => ['تأمين صحي', 'عمل عن بعد', 'مكتب مرن'],
                'status' => 'active',
                'expires_at' => Carbon::now()->addMonths(2),
            ],

            // Company 5 - Consulting Company
            [
                'company_id' => $companies[4]->id,
                'title' => 'مستشار إداري',
                'description' => 'نحتاج مستشار إداري لتقديم استشارات استراتيجية للشركات والعملاء.',
                'location' => 'الرياض',
                'type' => 'دوام كامل',
                'experience_level' => 'متقدم',
                'salary_min' => 10000,
                'salary_max' => 18000,
                'salary_currency' => 'SAR',
                'skills' => ['Strategic Planning', 'Business Analysis', 'Change Management', 'Leadership'],
                'benefits' => ['تأمين صحي', 'بدل سكن', 'بدل نقل'],
                'status' => 'active',
                'expires_at' => Carbon::now()->addMonths(3),
            ],
            [
                'company_id' => $companies[4]->id,
                'title' => 'محلل أعمال',
                'description' => 'نبحث عن محلل أعمال لتحليل العمليات التجارية وتقديم توصيات للتحسين.',
                'location' => 'جدة',
                'type' => 'دوام كامل',
                'experience_level' => 'متوسط',
                'salary_min' => 6000,
                'salary_max' => 11000,
                'salary_currency' => 'SAR',
                'skills' => ['Business Analysis', 'Process Improvement', 'Data Analysis', 'Documentation'],
                'benefits' => ['تأمين صحي', 'بدل تعليم', 'مكافآت سنوية'],
                'status' => 'active',
                'expires_at' => Carbon::now()->addMonths(2),
            ],

            // Some paused/closed jobs
            [
                'company_id' => $companies[0]->id,
                'title' => 'مطور باك إند (معلق)',
                'description' => 'وظيفة مطور باك إند متخصص في Node.js و MongoDB.',
                'location' => 'الرياض',
                'type' => 'دوام كامل',
                'experience_level' => 'متوسط',
                'salary_min' => 7000,
                'salary_max' => 12000,
                'salary_currency' => 'SAR',
                'skills' => ['Node.js', 'MongoDB', 'Express.js', 'JavaScript'],
                'benefits' => ['تأمين صحي', 'عمل عن بعد'],
                'status' => 'paused',
                'expires_at' => Carbon::now()->addMonths(1),
            ],
            [
                'company_id' => $companies[1]->id,
                'title' => 'محاسب (مغلق)',
                'description' => 'وظيفة محاسب لمراجعة الحسابات والبيانات المالية.',
                'location' => 'الدمام',
                'type' => 'دوام كامل',
                'experience_level' => 'مبتدئ',
                'salary_min' => 5000,
                'salary_max' => 8000,
                'salary_currency' => 'SAR',
                'skills' => ['Accounting', 'Bookkeeping', 'Financial Statements'],
                'benefits' => ['تأمين صحي'],
                'status' => 'closed',
                'expires_at' => Carbon::now()->subDays(30),
            ],
        ];

        foreach ($jobs as $job) {
            // Check if job already exists by title and company
            if (!Job::where('title', $job['title'])->where('company_id', $job['company_id'])->exists()) {
                Job::create($job);
            }
        }
    }
}
