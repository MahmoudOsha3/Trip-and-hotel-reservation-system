<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company ;

class CompanySeeder extends Seeder
{

    public function run()
    {
        $data = [
            [
                'title' => json_encode([
                    'ar' => 'شركة الرحلات الممتعة',
                    'en' => 'Fun Trips Company',
                ]),
                'about_company' => json_encode([
                    'ar' => 'شركة تقدم أفضل الرحلات السياحية داخل مصر بأسعار تنافسية.',
                    'en' => 'A company offering the best tourist trips within Egypt at competitive prices.',
                ]),
                'address' => json_encode([
                    'ar' => 'القاهرة، مصر',
                    'en' => 'Cairo, Egypt',
                ]),
                'contact_number' => '+201234567890',
                'type_company_id' => 1, // تأكد من مطابقة هذا المعرف مع معرف النوع المناسب
                'owner_id' => 1, // تأكد من مطابقة هذا المعرف مع معرف المالك المناسب
            ],
            [
                'title' => json_encode([
                    'ar' => 'شركة السياحة الرائدة',
                    'en' => 'Leading Tourism Company',
                ]),
                'about_company' => json_encode([
                    'ar' => 'شركة متخصصة في تنظيم الرحلات السياحية إلى أشهر المعالم السياحية في مصر.',
                    'en' => 'A company specializing in organizing trips to Egypt\'s most famous tourist attractions.',
                ]),
                'address' => json_encode([
                    'ar' => 'الإسكندرية، مصر',
                    'en' => 'Alexandria, Egypt',
                ]),
                'contact_number' => '+201098765432',
                'type_company_id' => 1, // تأكد من مطابقة هذا المعرف مع معرف النوع المناسب
                'owner_id' => 2, // تأكد من مطابقة هذا المعرف مع معرف المالك المناسب
            ],
            [
                'title' => json_encode([
                    'ar' => 'شركة السياحة الحديثة',
                    'en' => 'Modern Travel Agency',
                ]),
                'about_company' => json_encode([
                    'ar' => 'شركة تقدم خدمات سياحية متكاملة لرحلات عائلية وجماعية.',
                    'en' => 'A company offering comprehensive travel services for family and group trips.',
                ]),
                'address' => json_encode([
                    'ar' => 'الأقصر، مصر',
                    'en' => 'Luxor, Egypt',
                ]),
                'contact_number' => '+202345678901',
                'type_company_id' => 1, // تأكد من مطابقة هذا المعرف مع معرف النوع المناسب
                'owner_id' => 3, // تأكد من مطابقة هذا المعرف مع معرف المالك المناسب
            ],
            // أضف المزيد من السجلات الواقعية حسب الحاجة
        ];

        foreach ($data as $item) {
            DB::table('companies')->insert($item);
        }
    }
}
