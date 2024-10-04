<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\gameCustomer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchasinfo>
 */
class PurchasinfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                    //gameCustomerは1000件あるので1〜1000の間でカウントをわり振る
            'game_customer_id' => rand(1, gameCustomer::count()),
            'status' => $this->faker->boolean        
        ];
    }
}
