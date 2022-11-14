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

        $data= [
            'status' => $this->faker->randomElement(Subscription::STATUSES),
            'amount' => $amount,
            'tax_amount' => $tax_amount,
            'total_amount' => $total,
            'payment_method' => 'cache',
            'end_date' => now()->addDays(30),
            'user_id' => User::factory()->create(),
        ];
        if ($data['status']=='active'){
            $data['status_ar'] = 'مفعل';
        }elseif ($data['status']=='in_active'){
            $data['status_ar'] = 'معطل';
        }  elseif ($data['status']=='finished') {
            $data['status_ar'] = 'منتهي';
        }else {
            $data['status_ar'] = 'ملغي';
        }
        return $data;
}


}
