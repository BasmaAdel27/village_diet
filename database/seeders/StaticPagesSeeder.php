<?php

namespace Database\Seeders;

use App\Models\StaticPage\StaticPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaticPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StaticPage::create([
            "is_active" => 1,
            "is_show_in_app" => 0,
            "slug" => "About-Village-Diet",
            'ar' => [
                'title' => 'نبذه عن فيلدج دايت',
                'content' => 'تسعى المنصة أن تصبح الانطلاقة الوطنية الجديدة داخل المجتمع السعودي في عالم الصحة واللياقة البدنية. عبر تجميع وعرض كافة المدربين التربية البدنية داخل المنصة وتقديم خدمة المتابعة الأونلاين عبر تواصل مباشر بين الطرفين. تم التقابل مع العميل وتحديد الجزء الاساسي من خواص المنصة وهذه الوثيقة شاملة جميع تفاصيل المنصة',
            ],
            'en' => [
                'title' => 'About Village Diet',
                'content' => 'The platform seeks to become the new national breakthrough within the Saudi society in the world of health and fitness. By collecting and displaying all physical education trainers within the platform and providing an online follow-up service through direct communication between the two parties. The client was interviewed and the main part of the platform’s features was determined. This document includes all the platform details',
            ]
        ]);
        StaticPage::create([
            "is_active" => 1,
            "is_show_in_app" => 0,
            "slug" => "Our-Vision",
            'ar' => [
                'title' => 'رؤيتنا',
                'content' => 'تسعى المنصة أن تصبح الانطلاقة الوطنية الجديدة داخل المجتمع السعودي في عالم الصحة واللياقة البدنية. عبر تجميع وعرض كافة المدربين التربية البدنية داخل المنصة وتقديم خدمة المتابعة الأونلاين عبر تواصل مباشر بين الطرفين. تم التقابل مع العميل وتحديد الجزء الاساسي من خواص المنصة وهذه الوثيقة شاملة جميع تفاصيل المنصة',
            ],
            'en' => [
                'title' => 'Our Vision',
                'content' => 'The platform seeks to become the new national breakthrough within the Saudi society in the world of health and fitness. By collecting and displaying all physical education trainers within the platform and providing an online follow-up service through direct communication between the two parties. The client was interviewed and the main part of the platform’s features was determined. This document includes all the platform details',
            ]
        ]);
        StaticPage::create([
            "is_active" => 1,
            "is_show_in_app" => 0,
            "slug" => "Food-Recipes",
            'ar' => [
                'title' => 'الوصفات الغذائيه',
                'content' => 'تسعى المنصة أن تصبح الانطلاقة الوطنية الجديدة داخل المجتمع السعودي في عالم الصحة واللياقة البدنية. عبر تجميع وعرض كافة المدربين التربية البدنية داخل المنصة وتقديم خدمة المتابعة الأونلاين عبر تواصل مباشر بين الطرفين. تم التقابل مع العميل وتحديد الجزء الاساسي من خواص المنصة وهذه الوثيقة شاملة جميع تفاصيل المنصة',
            ],
            'en' => [
                'title' => 'food recipes',
                'content' => 'The platform seeks to become the new national breakthrough within the Saudi society in the world of health and fitness. By collecting and displaying all physical education trainers within the platform and providing an online follow-up service through direct communication between the two parties. The client was interviewed and the main part of the platform’s features was determined. This document includes all the platform details',
            ]
        ]);
    }
}
