<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'f_name'   => 'Admin',
            'l_name'   => 'Admin',
            'm_name'   => 'Admin',
            'gender'   => 'Female',
            'location' => 'Manila',
            'date_birth' => '2002-02-02',
            'phone_no' => '09687235269',
            'username' => 'admin',
            'role'     => '1',
            'password' => 'password'
        ]);
    }
}
