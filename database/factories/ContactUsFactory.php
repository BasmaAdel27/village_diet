<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactUsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'content' => $this->faker->text(100),
            'phone' => $this->faker->phoneNumber(),
            'whatsapp_phone' => $this->faker->phoneNumber(),
        ];
    }
}
