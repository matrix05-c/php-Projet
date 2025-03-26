<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("services")->insert([
            [
            'numServ' => 1,
            'service' => 'Gonflage',
            'prix' => 5000
            ],
            [
            'numServ' => 2,
            'service' => 'Lavage',
            'prix' => 4500
            ]
        ]);
    }
}
