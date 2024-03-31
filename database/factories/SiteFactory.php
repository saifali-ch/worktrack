<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SiteFactory extends Factory
{
    public function definition(): array {
        $dates = collect(range(1, 10))->map(function () {
            return \Carbon\Carbon::now()->subDays(fake()->numberBetween(1, 365));
        });

        $months = [
            \Carbon\Carbon::now(),
            Carbon::now()->subMonthNoOverflow()->startOfMonth(),
            ...$dates
        ];

        return [
            'name' => fake()->company(),
            'created_at' => fake()->randomElement($months),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
