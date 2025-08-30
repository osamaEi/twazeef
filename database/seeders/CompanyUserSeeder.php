<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CompanyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample company users
        $companies = [
            [
                'name' => 'شركة التقنية المتقدمة',
                'email' => 'company1@example.com',
                'password' => Hash::make('password'),
                'role' => 'company',
                'phone' => '+966501234567',
                'bio' => 'شركة رائدة في مجال التكنولوجيا والبرمجة',
                'company_name' => 'شركة التقنية المتقدمة',
                'website' => 'https://tech-company.com',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'شركة الخدمات المالية',
                'email' => 'company2@example.com',
                'password' => Hash::make('password'),
                'role' => 'company',
                'phone' => '+966502345678',
                'bio' => 'مؤسسة مالية تقدم خدمات مصرفية متكاملة',
                'company_name' => 'شركة الخدمات المالية',
                'website' => 'https://finance-company.com',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'شركة التسويق الرقمي',
                'email' => 'company3@example.com',
                'password' => Hash::make('password'),
                'role' => 'company',
                'phone' => '+966503456789',
                'bio' => 'متخصصون في التسويق الرقمي والإعلانات',
                'company_name' => 'شركة التسويق الرقمي',
                'website' => 'https://marketing-company.com',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'شركة التصميم والإبداع',
                'email' => 'company4@example.com',
                'password' => Hash::make('password'),
                'role' => 'company',
                'phone' => '+966504567890',
                'bio' => 'نبتكر تصاميم فريدة ومبتكرة',
                'company_name' => 'شركة التصميم والإبداع',
                'website' => 'https://design-company.com',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'شركة الاستشارات الإدارية',
                'email' => 'company5@example.com',
                'password' => Hash::make('password'),
                'role' => 'company',
                'phone' => '+966505678901',
                'bio' => 'نقدم استشارات إدارية واستراتيجية للشركات',
                'company_name' => 'شركة الاستشارات الإدارية',
                'website' => 'https://consulting-company.com',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($companies as $company) {
            if (!User::where('email', $company['email'])->exists()) {
                User::create($company);
            }
        }
    }
}
