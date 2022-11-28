<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MattDaneshvar\Survey\Models\Survey;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $survey_en = Survey::create(['name' => 'Health Model']);
        $survey_ar = Survey::create(['name' => 'النموذج الصحي']);

        $info_ar = $survey_ar->sections()->create(['name' => 'معلومات عامة']);
        $info_en = $survey_en->sections()->create(['name' => 'Global Information']);


        $info_en->questions()->create([
            'content' => 'What do you want to achieve during the next 4 weeks?',
            'type' => 'radio',
            'options' => [
                'Healthy life in general',
                'increase performance',
                'increase revolution',
                'maintain weight',
                'Lose weight',
            ]
        ]);

        $info_ar->questions()->create([
            'content' => 'ماذا تريد أن تحقق خلال ال4 أسابيع القادمة ؟',
            'type' => 'radio',
            'options' => [
                'حياة صحية بشكل عام',
                'زيادة الأداء',
                'زيادة القوه',
                'الحفاظ علي الوزن',
                'خسارة الوزن',
            ]
        ]);


        $info_en->questions()->create([
            'content' => 'Daily stress level',
            'type' => 'radio',
            'options' => [
                'daily stress level',
                'very high',
                'high',
                'Average',
                'low',
                'very simple',
            ]
        ]);

        $info_ar->questions()->create([
            'content' => 'مستوي التوتر و الضغط اليومي',
            'type' => 'radio',
            'options' => [
                'عالي جدا',
                'عالي',
                'متوسط',
                'منخفض',
                'بسيط جدا',
            ]
        ]);


        $info_en->questions()->create([
            'content' => 'Average number of hours of sleep',
        ]);

        $info_en->questions()->create([
            'content' => 'Current weight (kg)',
        ]);

        $info_en->questions()->create([
            'content' => 'Length (cm)',
        ]);

        $info_en->questions()->create([
            'content' => 'Job ',
        ]);

        $info_ar->questions()->create([
            'content' => 'متوسط عدد ساعات النوم',
        ]);

        $info_ar->questions()->create([
            'content' => 'الوزن الحالي (كجم)',
        ]);

        $info_ar->questions()->create([
            'content' => 'الطول (سم)',
        ]);

        $info_ar->questions()->create([
            'content' => 'المهنة ',
        ]);

        $info_en->questions()->create([
            'content' => 'Marital status',
            'type' => 'radio',
            'options' => [
                'Single',
                'married',
                'divorced',
                'Widower',
            ]
        ]);

        $info_ar->questions()->create([
            'content' => 'الحالة الاجتماعية',
            'type' => 'radio',
            'options' => [
                'أعزب',
                'متزوج',
                'مطلق',
                'أرمل',
            ]
        ]);


        $info_en->questions()->create([
            'content' => 'Do You Have Children ?',
            'type' => 'radio',
            'options' => [
                'Yes',
                'No'
            ]
        ]);

        $info_ar->questions()->create([
            'content' => 'هل لديك الأطفال ؟',
            'type' => 'radio',
            'options' => [
                'نعم',
                'لا'
            ]
        ]);

        $info_en->questions()->create([
            'content' => 'gender',
            'type' => 'radio',
            'options' => [
                'Male',
                'Female'
            ]
        ]);

        $info_ar->questions()->create([
            'content' => 'الجنس',
            'type' => 'radio',
            'options' => [
                'ذكر',
                'أنثي'
            ]
        ]);


        $sport_ar = $survey_ar->sections()->create(['name' => 'مستوي الرياضة']);
        $sport_en = $survey_en->sections()->create(['name' => 'Sport Level']);

        $sport_ar->questions()->create([
            'content' => 'هل تمارس الرياضة',
            'type' => 'radio',
            'options' => [
                'لا أمارس الرياضة',
                'مبتدئ',
                'متقدم',
            ]
        ]);

        $sport_en->questions()->create([
            'content' => 'Do you practice sport ?',
            'type' => 'radio',
            'options' => [
                'I don\'t do sports',
                'junior',
                'advanced'
            ]
        ]);

        $sport_ar->questions()->create([
            'content' => 'ما هي الأدوات الرياضية المتوفرة لديك ؟',
            'type' => 'radio',
            'options' => [
                'نادي رياضي متكامل',
                'نادي رياضي بسيط في المنزل',
                'لا بوجد',
            ]
        ]);

        $sport_en->questions()->create([
            'content' => 'What sports equipment do you have?',
            'type' => 'radio',
            'options' => [
                'Integrated gym',
                'Simple gym at home',
                'no'
            ]
        ]);

        $sport_ar->questions()->create([
            'content' => 'هل أنت مدخن ؟',
            'type' => 'radio',
            'options' => [
                'نعم',
                'لا'
            ]
        ]);

        $sport_en->questions()->create([
            'content' => 'Do you smoke ?',
            'type' => 'radio',
            'options' => [
                'Yes',
                'No'
            ]
        ]);

        $sport_ar->questions()->create([
            'content' => 'مستوي النشاط اليومي',
            'type' => 'radio',
            'options' => [
                'عالي - اتحرك وامشي طوال اليوم',
                'متوسط - امشي و اتحرك قليلا',
                'منخفض - لا اتحرك كثيرا',
            ]
        ]);

        $sport_en->questions()->create([
            'content' => 'Daily activity level',
            'type' => 'radio',
            'options' => [
                'High - move and walk all day',
                'Medium - walk and move a little',
                'Low - I don\'t move much',
            ]
        ]);


        $survey_en->questions()->create([
            'content' => 'How often do you eat outside the house?',
            'type' => 'radio',
            'options' => [
                'every day',
                '4-6 times a week',
                '1-3 times a week',
                'Once a week',
                'I only eat home food',
            ]
        ]);

        $survey_ar->questions()->create([
            'content' => 'كم مرة تأكل خارج المنزل ؟',
            'type' => 'radio',
            'options' => [
                'كل يوم',
                '4-6 مرات في الأسبوع',
                '1-3 مرات في الأسبوع',
                'مرة واحدة في الأسبوع',
                'لا أتناول غير طعام المنزل',
            ]
        ]);

        $survey_en->questions()->create([
            'content' => 'Do you enjoy eating early breakfast?',
            'type' => 'radio',
            'options' => [
                'Yes',
                'No'
            ]
        ]);

        $survey_ar->questions()->create([
            'content' => 'هل تستمتع بتناول الافطار مبكرا ؟',
            'type' => 'radio',
            'options' => [
                'نعم',
                'لا'
            ]
        ]);


        $survey_en->questions()->create([
            'content' => 'Do you have an allergy to certain foods?',
            'type' => 'radio',
            'options' => [
                'Yes',
                'No'
            ]
        ]);

        $survey_ar->questions()->create([
            'content' => ' هل لديك حساسية من بعض الأطعمة؟',
            'type' => 'radio',
            'options' => [
                'نعم',
                'لا'
            ]
        ]);

        $survey_en->questions()->create([
            'content' => 'Allergenic foods'
        ]);

        $survey_ar->questions()->create([
            'content' => ' الأطعمة المسببة للحساسية'
        ]);

        $survey_en->questions()->create([
            'content' => 'Your favorite types of food'
        ]);

        $survey_ar->questions()->create([
            'content' => 'أنواع الطعام المفضلة لديك'
        ]);


        $measurement_ar = $survey_ar->sections()->create(['name' => 'القياسات']);
        $measurement_en = $survey_en->sections()->create(['name' => 'Measurements']);


        $measurement_ar->questions()->create([
            'content' => 'أعلي الذراع في المنتصف بين الكوع و الكتف (سم)'
        ]);
        $measurement_ar->questions()->create([
            'content' => 'قياس الوسط 5 سم أسفل الصرة (سم)'
        ]);
        $measurement_ar->questions()->create([
            'content' => 'قياس الوسط 5 سم فوق الصرة (سم)'
        ]);
        $measurement_ar->questions()->create([
            'content' => 'قياس الوسط عند الصرة (سم)'
        ]);
        $measurement_ar->questions()->create([
            'content' => 'أعلي الساق في المنتصف بين الركبة و الورك (سم)'
        ]);

        $measurement_en->questions()->create([
            'content' => 'Upper arm centered between elbow and shoulder (cm)'
        ]);
        $measurement_en->questions()->create([
            'content' => 'Waist Measurement: 5 cm below the navel (cm)'
        ]);
        $measurement_en->questions()->create([
            'content' => 'Waist measurement 5 cm above the navel (cm)'
        ]);
        $measurement_en->questions()->create([
            'content' => 'Waist at the belly button (cm)'
        ]);
        $measurement_en->questions()->create([
            'content' => 'Upper leg midway between knee and hip (cm)'
        ]);
    }
}
