<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategoris')->insert([
            [
                'nama' => 'Fiksi'
            ],
            [
                'nama' => 'Non-Fiksi'
            ],
            [
                'nama' => 'Novel'
            ],
            [
                'nama' => 'Ensiklopedia'
            ],
            [
                'nama' => 'Pendidikan'
            ],
            [
                'nama' => 'Kamus'
            ],
            [
                'nama' => 'Biografi'
            ],
            [
                'nama' => 'Filsafat'
            ]
        ]);
    }
}
