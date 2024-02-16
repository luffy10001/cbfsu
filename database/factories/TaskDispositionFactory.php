<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TaskDisposition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\TaskDisposition>
 */
final class TaskDispositionFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = TaskDisposition::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'disposition_name' => fake()->optional()->word,
            'parent_id' => fake()->optional()->word,
        ];
    }
}
