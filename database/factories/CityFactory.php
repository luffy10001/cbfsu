<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\City>
 */
final class CityFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = City::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'description' => fake()->optional()->text,
            'region_id' => \App\Models\Region::factory(),
            'is_active' => fake()->boolean,
            //'city_id' => \App\Models\Province::factory(),
        ];
    }
}
