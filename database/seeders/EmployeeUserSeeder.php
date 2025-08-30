<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample employee users
        $employees = [
            [
                'name' => 'أحمد محمد علي',
                'email' => 'employee1@example.com',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'phone' => '+966506789012',
                'bio' => 'مطور ويب ذو خبرة 5 سنوات في تطوير المواقع والتطبيقات',
                'skills' => ['PHP', 'Laravel', 'JavaScript', 'Vue.js', 'MySQL'],
                'email_verified_at' => now(),
            ],
            [
                'name' => 'فاطمة أحمد حسن',
                'email' => 'employee2@example.com',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'phone' => '+966507890123',
                'bio' => 'مصممة جرافيك محترفة مع خبرة في التصميم الرقمي',
                'skills' => ['Photoshop', 'Illustrator', 'Figma', 'UI/UX Design'],
                'email_verified_at' => now(),
            ],
            [
                'name' => 'محمد عبدالله سالم',
                'email' => 'employee3@example.com',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'phone' => '+966508901234',
                'bio' => 'محلل مالي مع خبرة في التحليل المالي وإدارة المخاطر',
                'skills' => ['Financial Analysis', 'Excel', 'Risk Management', 'Accounting'],
                'email_verified_at' => now(),
            ],
            [
                'name' => 'سارة خالد أحمد',
                'email' => 'employee4@example.com',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'phone' => '+966509012345',
                'bio' => 'متخصصة في التسويق الرقمي وإدارة وسائل التواصل الاجتماعي',
                'skills' => ['Digital Marketing', 'Social Media', 'SEO', 'Content Creation'],
                'email_verified_at' => now(),
            ],
            [
                'name' => 'علي حسن محمد',
                'email' => 'employee5@example.com',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'phone' => '+966500123456',
                'bio' => 'مهندس برمجيات متخصص في تطوير تطبيقات الموبايل',
                'skills' => ['React Native', 'Flutter', 'Android', 'iOS', 'Firebase'],
                'email_verified_at' => now(),
            ],
            [
                'name' => 'نورا عبدالرحمن',
                'email' => 'employee6@example.com',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'phone' => '+966501234567',
                'bio' => 'مدربة موارد بشرية مع خبرة في تطوير المهارات',
                'skills' => ['HR Training', 'Leadership', 'Communication', 'Team Building'],
                'email_verified_at' => now(),
            ],
            [
                'name' => 'خالد سعد عبدالله',
                'email' => 'employee7@example.com',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'phone' => '+966502345678',
                'bio' => 'مطور باك إند متخصص في قواعد البيانات والـ APIs',
                'skills' => ['Python', 'Django', 'PostgreSQL', 'Docker', 'AWS'],
                'email_verified_at' => now(),
            ],
            [
                'name' => 'ريم محمد علي',
                'email' => 'employee8@example.com',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'phone' => '+966503456789',
                'bio' => 'مترجمة محترفة مع خبرة في الترجمة القانونية والتقنية',
                'skills' => ['Arabic-English', 'Legal Translation', 'Technical Translation'],
                'email_verified_at' => now(),
            ],
        ];

        foreach ($employees as $employee) {
            if (!User::where('email', $employee['email'])->exists()) {
                User::create($employee);
            }
        }
    }
}
