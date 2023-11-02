<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bukus')->insert([
            [
                'kategori_id' => '8',
                'judul' => 'Filosofi Teras',
                'pengarang' => 'Henry Manampiring',
                'penerbit' => 'Kompas',
                'deskripsi' => 'Filosofi Teras adalah sebuah buku pengantar filsafat Stoa yang dibuat khusus sebagai panduan moral anak muda.',
                'image' => 'https://www.gramedia.com/blog/content/images/2019/02/Review-Buku-Filosofi-Teras-Gramedia-2.jpg',
                'uuid' => Str::orderedUuid(),
                'stok' => 5,
                'created_at' => now()
            ],
            [
                'kategori_id' => '2',
                'judul' => 'Clean Code',
                'pengarang' => 'Robert C. Martin',
                'penerbit' => 'Kompas',
                'deskripsi' => 'Writing a code is not about typing random stuff, but to communicate. This is a book about how to write clean and readable code.',
                'image' => 'https://5.imimg.com/data5/WZ/NH/HL/SELLER-99655515/clean-code-a-handbook-of-agile-software-craftsmanship-book.jpg',
                'uuid' => Str::orderedUuid(),
                'stok' => 5,
                'created_at' => now()
            ],
            [
                'kategori_id' => '4',
                'judul' => 'Ensiklopedia Favoritku: Bumi',
                'pengarang' => 'Fleurus',
                'penerbit' => 'Bhuana Ilmu Populer',
                'deskripsi' => 'Buku Ensiklopedia Favoritku: Bumi ini sangat cocok untuk diberikan kepada anak, karena dengan buku ini, anak Anda dapat belajar untuk mengenal bumi melalui ilustrasi.',
                'image' => 'https://cdn.gramedia.com/uploads/items/9786023947126_ensiklopedia-favoritku-bumi.jpg',
                'uuid' => Str::orderedUuid(),
                'stok' => 5,
                'created_at' => now()
            ],
            [
                'kategori_id' => '5',
                'judul' => 'Tabel Periodik Unsur Kimia',
                'pengarang' => 'Tim Redaksi Bip',
                'penerbit' => 'Bhuana Ilmu Populer',
                'deskripsi' => 'Tabel periodik, juga dikenal sebagai tabel periodik unsur (kimia), adalah tampilan tabular dari unsur-unsur kimia. Tabel ini banyak digunakan dalam kimia, fisika, dan ilmu-ilmu lainnya, dan umumnya dipandang sebagai ikon dari kimia.',
                'image' => 'https://cdn.gramedia.com/uploads/items/9786232166011_Tabel_Periodik_Unsur.jpg',
                'uuid' => Str::orderedUuid(),
                'stok' => 5,
                'created_at' => now()
            ],
            [
                'kategori_id' => '5',
                'judul' => 'Tips: Radiant Dalam 1 Minggu',
                'pengarang' => 'Febrian Roho',
                'penerbit' => 'Gramedia',
                'deskripsi' => 'Lelah ketemu team otak dengkul asal entry langsung rata? Buku ini menyediakan berbagai cara dalam meraih rank impian mu.',
                'image' => 'https://www.gamingtoptens.com/wp-content/uploads/2020/06/valorant-rank.png',
                'uuid' => Str::orderedUuid(),
                'stok' => 0,
                'created_at' => now()
            ]

        ]);
    }
}
