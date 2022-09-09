<?php

namespace Database\Seeders;

use App\Models\ContactUs;
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
        $user = \App\Models\User::factory()->create([
            'email' => config('permission.admin_user_name')
        ])->assignRole('admin');

        User::factory(100)->create();
        ContactUs::factory(50)->create();
        $this->call(DaySeeder::class);
    }
}
