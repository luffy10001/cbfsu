<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Agency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Agency>
 */
final class AgencyFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Agency::class;

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
            'company_phone' => fake()->optional()->word,
            'company_fax' => fake()->optional()->word,
            'postal_address' => fake()->optional()->text,
            'latitude' => fake()->optional()->latitude,
            'longitude' => fake()->optional()->longitude,
            'email_address' => fake()->optional()->safeEmail,
            'website' => fake()->optional()->word,
            'service_description' => fake()->optional()->text,
            'logo_image' => fake()->optional()->text,
            'card_shop_image' => fake()->optional()->text,
            'owner_name' => fake()->optional()->word,
            'owner_designation' => fake()->optional()->word,
            'owner_message' => fake()->optional()->text,
            'owner_picture' => fake()->optional()->text,
            'is_active' => fake()->boolean,
            'deleted_at' => fake()->optional()->dateTime(),
            'owner_phone_1' => fake()->optional()->word,
            'owner_phone_2' => fake()->optional()->word,
            'owner_phone_3' => fake()->optional()->word,
            'status' => fake()->optional()->word,
        ];
    }
}
