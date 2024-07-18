<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Website>
 */
class WebsiteFactory extends Factory
{
    protected $model = Website::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // create a user if not exists
            'url' => $this->faker->unique()->url,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }
}
