<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ShiftFactory extends Factory
{
    public function definition(): array {

        $userIds = User::pluck('id')->toArray();
        $invoiceIds = Invoice::pluck('id')->toArray();
        $siteIds = Site::pluck('id')->toArray();

        return [
            'user_id' => fake()->randomElement($userIds),
            'invoice_id' => fake()->randomElement($invoiceIds),
            'site_id' => fake()->randomElement($siteIds),
            'date' => fake()->date(),
            'start_time' => Carbon::now(),
            'finish_time' => Carbon::now()->addHours(3),
            'rate' => fake()->randomFloat(2, 10, 50),
            'total' => fake()->randomFloat(2, 50, 200),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
