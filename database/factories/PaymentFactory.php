<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Payment>
 */
final class PaymentFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Payment::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'parent_id' => fake()->optional()->randomNumber(),
            'contract_id' => fake()->optional()->randomNumber(),
            'type' => fake()->word,
            'is_partial_payment' => fake()->optional()->boolean,
            'payment_amount' => fake()->optional()->randomNumber(),
            'cash_deposit_slip' => fake()->optional()->word,
            'online_reference' => fake()->optional()->word,
            'online_screenshot' => fake()->optional()->word,
            'cheque_bank' => fake()->optional()->word,
            'cheque_instrument' => fake()->optional()->word,
            'cheque_issue_date' => fake()->optional()->word,
            'cheque_image' => fake()->optional()->word,
            'cheque_deposit_slip' => fake()->optional()->word,
            'no_of_installments' => fake()->optional()->randomNumber(),
            'status' => fake()->optional()->word,
            'amount_paid' => fake()->optional()->word,
            'agency_id' => \App\Models\Agency::factory(),
        ];
    }
}
