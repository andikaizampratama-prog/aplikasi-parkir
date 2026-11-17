<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(
            ['email' => 'admin@parkirku.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('AdminParkir123!'),
                'role' => 'admin',
            ]
        );

        // PETUGAS
        User::updateOrCreate(
            ['email' => 'petugas@parkirku.com'],
            [
                'name' => 'Petugas Parkir',
                'password' => Hash::make('PetugasParkir123!'),
                'role' => 'petugas',
            ]
        );

        // OWNER
        User::updateOrCreate(
            ['email' => 'owner@parkirku.com'],
            [
                'name' => 'Owner Parkir',
                'password' => Hash::make('OwnerParkir123!'),
                'role' => 'owner',
            ]
        );
    }
}
