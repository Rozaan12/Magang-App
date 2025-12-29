<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->updateOrInsert(
            ['email' => 'admin_magang@gmail.com'],
            [
                'name' => 'Admin Magang',
                'password' => \Hash::make('password_admin_2025'),
                'role' => 'admin',
                'status' => '1',
                'no_telp' => '08123456789',
                'alamat' => 'Kantor Sarastya Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
