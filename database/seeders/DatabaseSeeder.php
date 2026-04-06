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

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Angota
        User::create([
           "username"   =>    "Gilanguno",
           "email"  =>    "gilang1@gmail.com",
           "password"=> bcrypt("12345678"),
           "role"   =>   "anggota"
        ]);
        // Petugas
        User::create([
           "username"   =>    "Gilangdos",
           "email"  =>    "gilang2@gmail.com",
           "password"=> bcrypt("12345678"),
           "role"   =>   "petugas"
        ]);
        // kepala
        User::create([
           "username"   =>    "Gilangtrez",
           "email"  =>    "gilang3@gmail.com",
           "password"=> bcrypt("12345678"),
           "role"   =>   "kepala_perpustakaan"
        ]);

    //   Kategori::create([
    //      "nama_kategori"   =>   "Aksi"
    //   ]);
    //   Kategori::create([
    //      "nama_kategori"   =>   "Fiksi"
    //   ]);
    //   Kategori::create([
    //      "nama_kategori"   =>   "Tech"
    //   ]);
    //   Kategori::create([
    //      "nama_kategori"   =>   "non-fiksi"
    //   ]);
    //   Kategori::create([
    //      "nama_kategori"   =>   "Komik"   
    //   ]);
    //   Kategori::create([
    //      "nama_kategori"   =>   "kartun"
    //   ]);
    }
}
