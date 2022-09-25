<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'net_subscription' => 300,
            'tax_name' => 'added tax',
            'tax_type' => 'fixed',
            'tax_amount' => '20',
            'website_url' => 'www.village.com',
            'ios_version' => 'v2.1.1',
            'android_version' => 'v1.1.1',
            'web_title' => Str::random(10),
            'web_description' => Str::random(100),
            'logo' => 'settings/unnamed.png',
            'footer' => 'Copyright © village Diet 2022',
            'latitude' => '24.7253981',
            'longitude' => '47.3830547',
            'address' => 'الرياض السعوديه',
            'phone' => '00966982662678',
            'whatsapp_number' => '00966982662678',

        ]);
    }
}
