<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $amount = rand(1, 100);
        $tax_amount = rand(1, 100);
        $total = $amount + $tax_amount;

        return [
            'status' => $this->faker->randomElement(Subscription::STATUSES),
            'amount' => $amount,
            'tax_amount' => $tax_amount,
            'total_amount' => $total,
            'payment_method' => 'cache',
            'end_date' => now()->addDays(30),
            'user_id' => User::factory()->create(),
        ];
    }
}
