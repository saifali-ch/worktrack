<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void {
        $emails = [
            'josh@ablou.co.uk',
            'tim@ablou.co.uk',
            'sam@ablou.co.uk',
            'phil@ablou.co.uk',
            'subcon@ablou.co.uk',
        ];

        foreach ($emails as $email) {
            User::create([
                'role' => 'admin',
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => $email,
                'password' => Str::password()
            ]);
        }
    }
}
