<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    public function definition(): array {

        $userIds = User::pluck('id')->toArray();

        $dates = collect(range(1, 10))->map(function () {
            return Carbon::now()->subDays(fake()->numberBetween(1, 365));
        });

        $months = [
            Carbon::now(),
            Carbon::now()->subMonthNoOverflow()->startOfMonth(),
            ...$dates
        ];

        return [
            'user_id' => fake()->randomElement($userIds),
            'status' => fake()->boolean(),
            'created_at' => fake()->randomElement($months),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
