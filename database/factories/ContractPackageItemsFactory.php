<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ContractPackageItems;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ContractPackageItems>
 */
final class ContractPackageItemsFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = ContractPackageItems::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'contract_id' => fake()->optional()->randomNumber(),
            'package_id' => fake()->optional()->randomNumber(),
            'addons_id' => \App\Models\PackageAddon::factory(),
            'quantity' => fake()->optional()->randomNumber(),
            'price' => fake()->optional()->randomNumber(),
            'sub_total' => fake()->optional()->randomNumber(),
        ];
    }
}
