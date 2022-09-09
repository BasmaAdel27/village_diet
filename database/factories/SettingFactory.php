<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
              'net_subscription' => 2000,
              'tax_name' => 'added tax',
              'tax_amount' => '50',
              'tax_type' => 'percent',
              'website_url' => 'www.village.com',
              'ios_version' => 'v 2.1.1',
              'android_version' => 'v2.3.4',
              'logo' => $this->faker->image(),
              'web_title' => $this->faker->text(20),
              'web_description' => $this->faker->text(150),
        ];
    }
}
