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
        // Menambahkan pengguna untuk staff
        DB::table('users')->insert([
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => Hash::make('staff@example.com'),
            'role' => 'kasir'
        ]);

        // Menambahkan pengguna untuk admin
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin@example.com'),
            'role' => 'admin'
        ]);

        // Menambahkan pengguna untuk admin
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('user@example.com'),
            'role' => 'pelanggan'
        ]);

        // Menambahkan data staf secara langsung ke dalam tabel 'staffs'
        DB::table('staffs')->insert([
            'nama' => 'Budi',
            'jabatan' => 'kasir',
            'email' => 'budi@gmail.com',
            'tanggung_jawab' => 'Menyiapkan pesanan'
        ]);

    }

}
