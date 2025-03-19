<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class serviceSeeder extends Seeder
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
