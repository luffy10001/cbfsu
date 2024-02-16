<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TaskSubType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\TaskSubType>
 */
final class TaskSubTypeFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = TaskSubType::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'task_type_id' => \App\Models\TaskType::factory(),
            'sub_type_name' => fake()->optional()->word,
        ];
    }
}
