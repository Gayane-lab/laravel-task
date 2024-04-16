<?php

namespace Database\Factories;

use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;
use Random\RandomException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        return [
            'website_id' => Website::get()->random()->id,
            'revenue' => $this->faker->randomFloat(),
            'impressions' => mt_rand(0,PHP_INT_MAX),
            'clicks' => mt_rand(0,PHP_INT_MAX),
            'date' => $this->faker->dateTimeBetween(now()->subMonth()->startOfMonth(), now())->format('Y-m-d')
        ];
    }
}
