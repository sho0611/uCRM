<?php

namespace Database\Factories;

use App\Http\Controllers\GamesController;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\gameCustomer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\gamePurchase>
 */
class GamePurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $decade = $this->faker->dateTimeThisDecade;
        $created_at = $decade->modify('+2 years');

        return [
            'created_at' => $created_at,
            'game_customer_id' => rand(1, gameCustomer::count()),
            'status' => $this->faker->boolean,
            ];
    }
}
