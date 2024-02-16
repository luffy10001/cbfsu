<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Area>
 */
final class AreaFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Area::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'name' => fake()->optional()->name,
            'description' => fake()->optional()->text,
//            'region_id' => \App\Models\Region::factory(),
            'cityId' => \App\Models\City::factory(),
            'active' => fake()->boolean,
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
