<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        User::factory()->create([
            'role' => 'admin',
            'first_name' => 'Saif',
            'last_name' => 'Ali',
            'email' => config('app.admin_email')
        ]);
    }
}
