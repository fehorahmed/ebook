<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'          => 'Admin',
            'email'         => 'admin@dev.com',
            'password'      => bcrypt('admin1234'),
            'user_type'     => 'admin',
            'email_verified_at' => \Carbon\Carbon::now()
        ]);
    }
}
