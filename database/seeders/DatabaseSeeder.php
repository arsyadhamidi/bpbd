<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'password' => bcrypt('12345678'),
            'level' => 'Admin',
            'created_at' => Carbon::now(),
            'created_by' => '1',
            'is_deleted' => '1'
        ]);
    }
}
