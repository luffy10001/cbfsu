<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PackageAddon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\PackageAddon>
 */
final class PackageAddonFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = PackageAddon::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'name' => fake()->optional()->name,
            'type' => fake()->optional()->word,
            'min' => fake()->optional()->word,
            'max' => fake()->optional()->word,
            'is_active' => fake()->optional()->boolean,
            'is_addone' => fake()->optional()->boolean,
            'price' => fake()->optional()->randomNumber(),
        ];
    }
}
