<?php

namespace Systha\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Systha\Core\Models\Admin;

class SvcAdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::query()->updateOrCreate(
            ['email' => 'admin@demo.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password123'),
                'is_active' => true,
            ],
        );
    }
}
