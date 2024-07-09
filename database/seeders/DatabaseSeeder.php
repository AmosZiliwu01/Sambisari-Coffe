<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus semua entri di tabel users
        DB::table('users')->truncate();


        // Data pengguna untuk admin
        $adminUsers = [
            ['name' => 'Admin User 1', 'email' => 'admin1@example.com'],
            ['name' => 'Admin User 2', 'email' => 'admin2@example.com'],
            ['name' => 'Admin User 3', 'email' => 'admin3@example.com'],
            ['name' => 'Admin User 4', 'email' => 'admin4@example.com'],
            ['name' => 'Admin User 5', 'email' => 'admin5@example.com'],
        ];

        // Data pengguna untuk staff
        $staffUsers = [
            ['name' => 'Staff User 1', 'email' => 'staff1@example.com'],
            ['name' => 'Staff User 2', 'email' => 'staff2@example.com'],
            ['name' => 'Staff User 3', 'email' => 'staff3@example.com'],
            ['name' => 'Staff User 4', 'email' => 'staff4@example.com'],
            ['name' => 'Staff User 5', 'email' => 'staff5@example.com'],
            ['name' => 'Staff User 6', 'email' => 'staff6@example.com'],
            ['name' => 'Staff User 7', 'email' => 'staff7@example.com'],
            ['name' => 'Staff User 8', 'email' => 'staff8@example.com'],
            ['name' => 'Staff User 9', 'email' => 'staff9@example.com'],
            ['name' => 'Staff User 10', 'email' => 'staff10@example.com'],
        ];

        // Data pengguna untuk user biasa
        $regularUsers = [
            ['name' => 'User 1', 'email' => 'user1@example.com'],
            ['name' => 'User 2', 'email' => 'user2@example.com'],
            ['name' => 'User 3', 'email' => 'user3@example.com'],
        ];

        // Menambahkan pengguna untuk admin
        foreach ($adminUsers as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['email']),
                'role' => 'admin'
            ]);
        }

        // Menambahkan pengguna untuk staff
        foreach ($staffUsers as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['email']),
                'role' => 'kasir'
            ]);
        }

        // Menambahkan pengguna untuk user biasa
        foreach ($regularUsers as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['email']),
                'role' => 'pelanggan'
            ]);
        }

        // Menambahkan data staf secara langsung ke dalam tabel 'staffs'
        DB::table('staffs')->insert([
            'nama' => 'Budi',
            'jabatan' => 'kasir',
            'email' => 'budi@gmail.com',
            'tanggung_jawab' => 'Menyiapkan pesanan'
        ]);
    }
}
