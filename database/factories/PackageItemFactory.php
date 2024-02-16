<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\PackageItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\PackageItem>
 */
final class PackageItemFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = PackageItem::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'package_id' => fake()->optional()->randomNumber(),
            'addons_id' => \App\Models\PackageAddon::factory(),
            'quantity' => fake()->optional()->randomNumber(),
            'price' => fake()->optional()->randomNumber(),
            'sub_total' => fake()->optional()->randomNumber(),
        ];
    }
}
