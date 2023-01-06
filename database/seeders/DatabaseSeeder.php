<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(PermissionSeeder::class);
        $user = \App\Models\User::factory()->create([
            'email' => config('permission.admin_user_name')
        ])->assignRole('admin');

        User::factory(5)->create();
        ContactUs::factory(50)->create();
        $this->call(DaySeeder::class);
        $this->call(SettingSeeder::class);
        Subscription::factory(50)->create();
        $this->call(SurveySeeder::class);
        $this->call(StaticPagesSeeder::class);
        $this->call(ServiceSeeder::class);
    }
}
