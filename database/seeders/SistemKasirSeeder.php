<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SistemKasirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleKasir = Role::firstOrCreate(['name' => 'kasir']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Warung',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole($roleAdmin);

        $kasir = User::firstOrCreate(
            ['email' => 'kasir@gmail.com'],
            [
                'name' => 'Kasir Utama',
                'password' => Hash::make('password'),
            ]
        );
        $kasir->assignRole($roleKasir);


        $kategoriGorengan = Categories::create([
            'nama' => 'Aneka Gorengan',
            'slug' => 'aneka-gorengan'
        ]);

        $kategoriKueBasah = Categories::create([
            'nama' => 'Kue Basah',
            'slug' => 'kue-basah'
        ]);

        // Produk Kategori: Gorengan
        Products::create([
            'category_id' => $kategoriGorengan->id,
            'nama_produk' => 'Bakwan Jagung',
            'harga_modal' => 1200,
            'harga_jual' => 2000,
            'stok' => 100,
            'tersedia' => true,
        ]);

        Products::create([
            'category_id' => $kategoriGorengan->id,
            'nama_produk' => 'Tahu Isi Pedas',
            'harga_modal' => 1500,
            'harga_jual' => 2500,
            'stok' => 80,
            'tersedia' => true,
        ]);

        Products::create([
            'category_id' => $kategoriGorengan->id,
            'nama_produk' => 'Tempe Mendoan',
            'harga_modal' => 1000,
            'harga_jual' => 2000,
            'stok' => 120,
            'tersedia' => true,
        ]);

        // Produk Kategori: Kue Basah
        Products::create([
            'category_id' => $kategoriKueBasah->id,
            'nama_produk' => 'Kue Lumpur Surga',
            'harga_modal' => 2000,
            'harga_jual' => 3500,
            'stok' => 40,
            'tersedia' => true,
        ]);

        Products::create([
            'category_id' => $kategoriKueBasah->id,
            'nama_produk' => 'Dadar Gulung Unti',
            'harga_modal' => 1500,
            'harga_jual' => 3000,
            'stok' => 50,
            'tersedia' => true,
        ]);

        Products::create([
            'category_id' => $kategoriKueBasah->id,
            'nama_produk' => 'Kue Lapis Legit Iris',
            'harga_modal' => 2500,
            'harga_jual' => 4000,
            'stok' => 30,
            'tersedia' => true,
        ]);
    }
}
