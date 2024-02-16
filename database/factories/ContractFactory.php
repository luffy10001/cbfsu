<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Contract>
 */
final class ContractFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Contract::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'agency_id' => \App\Models\Agency::factory(),
            'close_user_id' => \App\Models\User::factory(),
            'created_user_id' => fake()->optional()->randomNumber(),
            'package_id' => fake()->optional()->randomNumber(),
            'addon_id' => fake()->optional()->randomNumber(),
            'payment_id' => fake()->optional()->randomNumber(),
            'amount' => fake()->optional()->randomNumber(),
            'duration' => fake()->optional()->randomNumber(),
            'sign_date' => fake()->optional()->date(),
            'start_date' => fake()->optional()->date(),
            'end_date' => fake()->optional()->date(),
            'category' => fake()->word,
            'foc' => fake()->optional()->randomNumber(),
            'adjust_unused_credits' => fake()->optional()->boolean,
            'addons_count' => fake()->optional()->randomNumber(),
            'total_cost' => fake()->optional()->randomNumber(),
        ];
    }
}
