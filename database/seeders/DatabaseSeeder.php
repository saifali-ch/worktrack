<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        User::create([
            'role' => 'admin',
            'first_name' => 'Saif',
            'last_name' => 'Ali',
            'email' => config('app.admin_email'),
            'password' => Str::password()
        ]);

//        Site::factory()->count(10)->create();
//        Invoice::factory()->count(100)->create();
//        Shift::factory()->count(100)->create();
//
//        User::factory(10)->create([
//            'role' => 'worker'
//        ]);

        $this->call(AdminUserSeeder::class);
    }
}
