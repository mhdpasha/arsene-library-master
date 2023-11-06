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
                'genre_id' => 'AR-FIK',
                'nama' => 'Fiksi',
                'deskripsi' => 'Dunia penuh khayalan dan cerita yang memikat. Kategori ini menyajikan beragam kisah fiksi yang dapat membawa Anda ke petualangan tak terbatas.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'genre_id' => 'AR-NON',
                'nama' => 'Non-Fiksi',
                'deskripsi' => 'Wahana pengetahuan dan kebenaran. Di sini, Anda akan menemukan kategori yang berisi kenyataan, fakta, dan wawasan yang bermanfaat.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'genre_id' => 'AR-NOV',
                'nama' => 'Novel',
                'deskripsi' => 'Cerita-cerita panjang yang menghipnotis. Kategori ini menampilkan novel-novel epik yang memikat hati dan pikiran Anda.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'genre_id' => 'AR-ENPD',
                'nama' => 'Ensiklopedia',
                'deskripsi' => 'Sumber daya pengetahuan terkemuka. Di sini, Anda akan menemukan ensiklopedia yang penuh dengan informasi bermanfaat dan mendalam.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'genre_id' => 'AR-PEN',
                'nama' => 'Pendidikan',
                'deskripsi' => 'Pintu menuju pengetahuan yang tak pernah berakhir. Kategori ini memuat buku-buku pendidikan yang mendukung perkembangan intelektual Anda.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'genre_id' => 'AR-KAM',
                'nama' => 'Kamus',
                'deskripsi' => 'Alat penting untuk pemahaman bahasa. Kategori ini berisi kamus-kamus lengkap yang membantu Anda dalam mengeksplorasi kata-kata.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'genre_id' => 'AR-BIO',
                'nama' => 'Biografi',
                'deskripsi' => 'Kisah-kisah kehidupan yang menginspirasi. Di sini, Anda akan menemukan biografi-biografi inspiratif tokoh-tokoh terkenal.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'genre_id' => 'AR-FLS',
                'nama' => 'Filsafat',
                'deskripsi' => 'Jendela ke pemikiran mendalam. Kategori ini menampilkan buku-buku filsafat yang memacu otak dan memperluas wawasan Anda.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);        
    }
}
