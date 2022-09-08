<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    }
}
