<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TaskReview;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\TaskReview>
 */
final class TaskReviewFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = TaskReview::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        return [
            'task_id' => \App\Models\Task::factory(),
            'task_disposition_id' => fake()->optional()->randomNumber(),
            'task_disposition_sub_id' => fake()->optional()->randomNumber(),
            'task_status_id' => \App\Models\TaskStatus::factory(),
            'comment' => fake()->optional()->word,
            'disposition_id' => \App\Models\TaskDisposition::factory(),
        ];
    }
}
