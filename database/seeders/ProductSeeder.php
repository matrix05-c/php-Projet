<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("produits")->insert([
            [
            'numProd' => 1,
            'design' => 'Gasoil',
            'stock' => 0,
            'prixProduit' => 5000
            ],
            [
            'numProd' => 2,
            'design' => 'Essence',
            'stock' => 0,
            'prixProduit' => 4500
            ],
            [
            'numProd' => 3,
            'design' => 'Petrole',
            'stock' => 0,
            'prixProduit' => 2500
            ]
        ]);
    }
}
