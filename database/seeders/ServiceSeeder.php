<?php

namespace Database\Seeders;

use App\Models\Service\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        // Work Way Steps
        // step 1
        $one = Service::create([
            'ar' => [
                'title' => 'عميلة التسجيل',
                'description' => 'سجل اشتراكك في المنصة أولا ومن ثم تابع مهامك',
            ],
            'en' => [
                'title' => 'Register',
                'description' => 'Register your subscription to the platform first and then continue your tasks',
            ],
            'ordering' => 1,
            'type' => 'WorkWay'
        ]);

        $one->images()->create([
            'media' => 'website/assets/images/works/work_1.svg',
            'option' => 'image',
        ]);
        // step 2
        $two = Service::create([
            'ar' => [
                'title' => 'تفعيل التطبيق',
                'description' => 'بعد ذلك يتم تفعيل حسابك من خلال تطبيق الجوال',
            ],
            'en' => [
                'title' => 'Activate Application',
                'description' => 'After that, your account will be activated through the mobile application',
            ],
            'ordering' => 2,
            'type' => 'WorkWay'
        ]);
        $two->images()->create([
            'media' => 'website/assets/images/works/work_2.svg',
            'option' => 'image',
        ]);
        // step 3
        $three =  Service::create([
            'ar' => [
                'title' => 'المتابعة اليومية',
                'description' => 'يم المتابعة اليومية لكل بياناتك الصحية',
            ],
            'en' => [
                'title' => 'Daily follow-up',
                'description' => 'Daily follow-up of all your health data',
            ],
            'ordering' => 3,
            'type' => 'WorkWay'
        ]);
        $three->images()->create([
            'media' => 'website/assets/images/works/work_3.svg',
            'option' => 'image',
        ]);
        // step 4
        $four = Service::create([
            'ar' => [
                'title' => 'التواجد في المجتمع',
                'description' => 'تواجد بعد ذلك في المجتمع الخاص بالمدرب',
            ],
            'en' => [
                'title' => 'Being in the community',
                'description' => 'Then he was present in the trainer\'s community',
            ],
            'ordering' => 4,
            'type' => 'WorkWay'
        ]);
        $four->images()->create([
            'media' => 'website/assets/images/works/work_4.svg',
            'option' => 'image',
        ]);

        // Store Services
        $five = Service::create([
            'ar' => [
                'title' => 'منتجات مميزة',
                'description' => 'مجموعة مميزة من المنتجات المختلفة',
            ],
            'en' => [
                'title' => 'Featured products',
                'description' => 'A distinctive group of different products',
            ],
            'ordering' => 1,
            'type' => 'Store'
        ]);
        $five->images()->create([
            'media' => 'website/assets/images/takes/take_1.svg',
            'option' => 'image',
        ]);


        $six = Service::create([
            'ar' => [
                'title' => 'ضمان شامل',
                'description' => 'ضمان شامل على كل منتجات فيلج دايت',
            ],
            'en' => [
                'title' => 'Comprehensive warranty',
                'description' => 'Comprehensive warranty on all Village Diet products',
            ],
            'ordering' => 2,
            'type' => 'Store'
        ]);
        $six->images()->create([
            'media' => 'website/assets/images/takes/take_2.svg',
            'option' => 'image',
        ]);

        $seven = Service::create([
            'ar' => [
                'title' => 'أسعار تنافسية',
                'description' => 'أسعار مميزة كثيرة بالنسبة للمتاجر الأخرى',
            ],
            'en' => [
                'title' => 'Competitive prices',
                'description' => 'Many special prices compared to other stores',
            ],
            'ordering' => 3,
            'type' => 'Store'
        ]);
        $seven->images()->create([
            'media' => 'website/assets/images/takes/take_3.svg',
            'option' => 'image',
        ]);


        $eight = Service::create([
            'ar' => [
                'title' => 'شحن سريع',
                'description' => 'افضل طرق الشحن خيارات توصيل سريع',
            ],
            'en' => [
                'title' => 'fast charging',
                'description' => 'Best shipping methods Fast delivery options',
            ],
            'ordering' => 4,
            'type' => 'Store'
        ]);
        $eight->images()->create([
            'media' => 'website/assets/images/takes/take_4.svg',
            'option' => 'image',
        ]);
    }
}
