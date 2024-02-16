<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\UserArea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\UserArea>
 */
final class UserAreaFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = UserArea::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'user_id' => fake()->optional()->randomNumber(),
            'area_id' => fake()->optional()->randomNumber(),
        ];
    }
}
