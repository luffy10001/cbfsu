<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Task>
 */
final class TaskFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Task::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'agency_id' => fake()->optional()->randomNumber(),
            'user_id' => \App\Models\User::factory(),
            'task_type_id' => \App\Models\TaskType::factory(),
            'task_sub_type_id' => \App\Models\TaskSubType::factory(),
            'disposition_id' => \App\Models\TaskDisposition::factory(),
            'task_status_id' => \App\Models\TaskStatus::factory(),
            'deadline' => fake()->optional()->date(),
            'notes' => fake()->optional()->text,
            'disposition_sub_id' => fake()->optional()->randomNumber(),
        ];
    }
}
