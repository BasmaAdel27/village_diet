<?php

namespace Database\Seeders;

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

        $faker = Factory::create();
        $gender = $faker->randomElement(['male', 'female']);
        foreach (range(1, 50) as $index) {
            DB::table('users')->insert([
                  'first_name' => $faker->name($gender),
                  'last_name' => $faker->name($gender),
                  'email' => $faker->email,
                  'phone' => $faker->phoneNumber,
                  'date_of_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
                  'email_verified_at' => Carbon::now(),
                'password'=>Hash::make('password')
            ]);
        }
    }
}
